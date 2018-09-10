<table class="wp-list-table widefat fixed posts" style="width: 65%">
    <thead>
        <tr>
            <th><?php _e( 'Id', 'estimated-delivery-woocommerce' ); ?></th>
            <th><?php _e('Shipping Class', 'estimated-delivery-woocommerce'); ?></th>
            <th><?php _e('No. of Days', 'estimated-delivery-woocommerce'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $test = new WC_Shipping;
        $shipping_classes = $test->get_shipping_classes(); 
        $this->shipping_class_table = array();
	$this->shipping_class_dates = get_option( 'wf_estimated_delivery_shipping_class' );
        $i=0;

        if(empty($this->shipping_class_dates))
        {
            foreach ( $shipping_classes as $id => $value ) {
                $this->shipping_class_table[$i]['id'] = $shipping_classes[$id]->slug;
                $this->shipping_class_table[$i]['name'] = $shipping_classes[$id]->name;
                $this->shipping_class_table[$i]['min_date'] = '';
                $i++;
            }
        } else {
                $i=0;
            foreach ( $this->shipping_class_dates as $id => $value ) {
                if(is_array($shipping_classes) && key_exists($id,$shipping_classes))
                {
                    $this->shipping_class_table[$i]['id'] = $shipping_classes[$id]->slug;
                    $this->shipping_class_table[$i]['name'] = $shipping_classes[$id]->name;
                    $this->shipping_class_table[$i]['min_date'] = $this->shipping_class_dates[$id]['min_date'];
                }
                $i++;
                unset($shipping_classes[$id]);
            }
            if(!empty($shipping_classes))
            {   $i=0;
                foreach ( $shipping_classes as $id => $value ) {
                    $this->shipping_class_table[$id]['id'] = $shipping_classes[$id]->slug;
                    $this->shipping_class_table[$id]['name'] = $shipping_classes[$id]->name;
                    $this->shipping_class_table[$id]['min_date'] = '';
                    $i++;
                }
            }
        }
        $i=0;
        foreach ( $this->shipping_class_table as $key => $value ){
        ?>

        <tr>
            <td>
                <input type="text" readonly name="wf_estimated_delivery_shipping_class[<?php echo $key; ?>][id]" value="<?php echo isset( $this->shipping_class_table[ $key ]['id'] ) ? $this->shipping_class_table[ $key ]['id'] : ''; ?>"/>
            </td>
            <td>
                <input type="text" readonly name="wf_estimated_delivery_shipping_class[<?php echo $key; ?>][name]" value="<?php echo isset( $this->shipping_class_table[ $key ]['name'] ) ? $this->shipping_class_table[ $key ]['name'] : ''; ?>"/>
            </td>
            <td >
                <input type="text" name="wf_estimated_delivery_shipping_class[<?php echo $key; ?>][min_date]" value="<?php echo isset( $this->shipping_class_table[ $key ]['min_date'] ) ? $this->shipping_class_table[ $key ]['min_date'] : ''; ?>"/>
            </td>
        </tr>
        <?php $i++;
        }
        ?>
    </tbody>
     <div>
        <p>Set delivery days for a particular Woocommerce Shipping Class.
        </p>
    <div>
</table>
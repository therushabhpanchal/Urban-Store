<?php

namespace WeDevs\DokanPro\Modules\Wholesale;

use WC_Product;

defined( 'ABSPATH' ) || exit;

/**
 * Wholesale Block data handler class.
 *
 * @since 3.7.13
 */
class BlockData {

    /**
     * Block Section name.
     *
     * @since 3.7.13
     *
     * @var string
     */
    public $section;

    /**
     * Meta key name.
     *
     * @since 3.7.13
     *
     * @var string
     */
    public $meta_key;

    /**
     * Constructor class.
     *
     * @since 3.7.13
     */
    public function __construct() {
        $this->section  = 'wholesale';
        $this->meta_key = '_dokan_wholesale_meta';

        add_filter( 'dokan_rest_get_product_block_data', [ $this, 'get_product_block_data' ], 10, 3 );
        add_filter( 'dokan_rest_get_product_variable_block_data', [ $this, 'get_product_block_data' ], 10, 3 );
        add_action( 'dokan_rest_insert_product_object', [ $this, 'set_product_block_data' ], 10, 3 );
    }

    /**
     * Get wholesale product data for Dokan-pro
     *
     * @since 3.7.13
     *
     * @param array      $block
     * @param WC_Product $product
     * @param string     $context
     *
     * @return array
     */
    public function get_product_block_data( $block, $product, $context = 'view' ) {
        if ( ! $product instanceof WC_Product ) {
            return;
        }

        $wholesale_data = $product->get_meta( $this->meta_key );
        $block[ $this->section ]['wholesale_price']    = ! empty( $wholesale_data['price'] ) ? $wholesale_data['price'] : '';
        $block[ $this->section ]['wholesale_quantity'] = ! empty( $wholesale_data['quantity'] ) ? $wholesale_data['quantity'] : '';

        if ( ! empty( $wholesale_data['enable_wholesale'] ) ) {
            $block[ $this->section ]['enable_wholesale'] = ( $wholesale_data['enable_wholesale'] !== 'no' || 'yes' === $wholesale_data['enable_wholesale'] );
        } else {
            $block[ $this->section ]['enable_wholesale'] = false;
        }

        return $block;
    }

    /**
     * Save wholesale data after REST-API insert or update.
     *
     * @since 3.7.13
     *
     * @param WC_Product      $product  Inserted object.
     * @param WP_REST_Request $request  Request object.
     * @param boolean         $creating True when creating object, false when updating.
     *
     * @return void
     */
    public function set_product_block_data( $product, $request, $creating = true ) {
        if ( ! $product instanceof WC_Product ) {
            return;
        }

        $data             = [];
        $data['price']    = ! empty( $request['wholesale_price'] ) ? wc_format_decimal( $request['wholesale_price'] ) : '';
        $data['quantity'] = ! empty( $request['wholesale_quantity'] ) ? absint( $request['wholesale_quantity'] ) : '';

        if ( ! empty( $request['enable_wholesale'] ) ) {
            $enable_wholesale = sanitize_text_field( wp_unslash( $request['enable_wholesale'] ) );
            $data['enable_wholesale'] = ( $enable_wholesale || 'yes' === $enable_wholesale ) ? 'yes' : 'no';
        } else {
            $data['enable_wholesale'] = 'no';
        }

        $product->update_meta_data( $this->meta_key, $data );
        $product->save();
    }
}

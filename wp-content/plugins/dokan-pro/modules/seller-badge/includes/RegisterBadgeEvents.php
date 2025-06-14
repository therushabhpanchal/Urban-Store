<?php
namespace WeDevs\DokanPro\Modules\SellerBadge;

use WeDevs\Dokan\Traits\Singleton;
use WeDevs\DokanPro\Modules\SellerBadge\Abstracts\BadgeEvents;
use WeDevs\DokanPro\Modules\SellerBadge\Models\BadgeEvent as BadgeEventModel;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // exit if accessed directly
}

/**
 * This class will be responsible for registering all badge events
 *
 * @since 3.7.14
 */
class RegisterBadgeEvents {
    use Singleton;

    /**
     * BadgeEvents objects
     *
     * @since 3.7.14
     *
     * @var BadgeEvents[]
     */
    private $event_classes = [];

    /**
     * Cloning is forbidden.
     *
     * @since 3.7.14
     */
    private function __clone() { }

    /**
     * Unserializing instances of this class is forbidden.
     *
     * @since 3.7.14
     */
    public function __wakeup() { }

    /**
     * This method will be called during class instantiate
     *
     * @since 3.7.14
     *
     * @return void
     */
    private function boot() {
        // loop through all badge events
        foreach ( Helper::get_dokan_seller_badge_events( '', true ) as $event_type ) {
            $event = Helper::get_dokan_seller_badge_events( $event_type );
            // check if we got a valid BadgeEvent type object
            if ( is_wp_error( $event ) || ! is_a( $event, BadgeEventModel::class  ) || ! $event->is_event_class_exists() ) {
                continue;
            }

            // get event class object
            if ( ! array_key_exists( $event->get_event_id(), $this->event_classes ) ) {
                $this->event_classes[ $event->get_event_id() ] = $this->instantiate_event_class( $event );
            }
        }
    }

    /**
     * Instantiate event class
     *
     * @param BadgeEventModel $event
     *
     * @since 3.7.14
     *
     * @return mixed|void
     */
    private function instantiate_event_class( $event ) {
        if ( $event->is_event_class_exists() ) {
            $class_name = $event->get_class();
            return new $class_name( $event->get_event_id() );
        }
    }
}

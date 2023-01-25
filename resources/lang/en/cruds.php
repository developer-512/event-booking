<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission' => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                        => 'ID',
            'id_helper'                 => ' ',
            'name'                      => 'First Name',
            'name_helper'               => ' ',
            'email'                     => 'Email',
            'email_helper'              => ' ',
            'email_verified_at'         => 'Email verified at',
            'email_verified_at_helper'  => ' ',
            'password'                  => 'Password',
            'password_helper'           => ' ',
            'roles'                     => 'Roles',
            'roles_helper'              => ' ',
            'remember_token'            => 'Remember Token',
            'remember_token_helper'     => ' ',
            'created_at'                => 'Created at',
            'created_at_helper'         => ' ',
            'updated_at'                => 'Updated at',
            'updated_at_helper'         => ' ',
            'deleted_at'                => 'Deleted at',
            'deleted_at_helper'         => ' ',
            'verified'                  => 'Verified',
            'verified_helper'           => ' ',
            'verified_at'               => 'Verified at',
            'verified_at_helper'        => ' ',
            'verification_token'        => 'Verification token',
            'verification_token_helper' => ' ',
            'lastname'                  => 'Last Name',
            'lastname_helper'           => ' ',
            'phone'                     => 'Phone',
            'phone_helper'              => ' ',
            'gender'                    => 'Gender',
            'gender_helper'             => ' ',
            'address'                   => 'Street Address',
            'address_helper'            => ' ',
            'address_2'                 => 'Apt, Suite, Building',
            'address_2_helper'          => ' ',
            'city'                      => 'City',
            'city_helper'               => ' ',
            'state'                     => 'State',
            'state_helper'              => ' ',
            'country'                   => 'Country',
            'country_helper'            => ' ',
            'profileimage'              => 'Profileimage',
            'profileimage_helper'       => ' ',
        ],
    ],
    'contentManagement' => [
        'title'          => 'Content management',
        'title_singular' => 'Content management',
    ],
    'contentCategory' => [
        'title'          => 'Categories',
        'title_singular' => 'Category',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'slug'              => 'Slug',
            'slug_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'contentTag' => [
        'title'          => 'Tags',
        'title_singular' => 'Tag',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'slug'              => 'Slug',
            'slug_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'contentPage' => [
        'title'          => 'Pages',
        'title_singular' => 'Page',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'title'                 => 'Title',
            'title_helper'          => ' ',
            'category'              => 'Categories',
            'category_helper'       => ' ',
            'tag'                   => 'Tags',
            'tag_helper'            => ' ',
            'page_text'             => 'Full Text',
            'page_text_helper'      => ' ',
            'excerpt'               => 'Excerpt',
            'excerpt_helper'        => ' ',
            'featured_image'        => 'Featured Image',
            'featured_image_helper' => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated At',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted At',
            'deleted_at_helper'     => ' ',
        ],
    ],
    'faqManagement' => [
        'title'          => 'Helpdesk/Faq Management',
        'title_singular' => 'Helpdesk/Faq Management',
    ],
    'faqCategory' => [
        'title'          => 'Categories',
        'title_singular' => 'Category',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'category'          => 'Category',
            'category_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'faqQuestion' => [
        'title'          => 'Questions',
        'title_singular' => 'Question',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'category'          => 'Category',
            'category_helper'   => ' ',
            'question'          => 'Question',
            'question_helper'   => ' ',
            'answer'            => 'Answer',
            'answer_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'blog' => [
        'title'          => 'Blogs Posts',
        'title_singular' => 'Blogs Post',
    ],
    'blogCategory' => [
        'title'          => 'Blogs Categories',
        'title_singular' => 'Blogs Category',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'slug'              => 'Slug',
            'slug_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'blogTag' => [
        'title'          => 'Blogs Tags',
        'title_singular' => 'Blogs Tag',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'slug'              => 'Slug',
            'slug_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'blogPost' => [
        'title'          => 'Blog Posts',
        'title_singular' => 'Blog Post',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'title'                 => 'Title',
            'title_helper'          => ' ',
            'category'              => 'Categories',
            'category_helper'       => ' ',
            'tag'                   => 'Tags',
            'tag_helper'            => ' ',
            'page_text'             => 'Full Text',
            'page_text_helper'      => ' ',
            'excerpt'               => 'Excerpt',
            'excerpt_helper'        => ' ',
            'featured_image'        => 'Featured Image',
            'featured_image_helper' => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated At',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted At',
            'deleted_at_helper'     => ' ',
        ],
    ],
    'country' => [
        'title'          => 'Countries',
        'title_singular' => 'Country',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'short_code'        => 'Short Code',
            'short_code_helper' => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'state' => [
        'title'          => 'States',
        'title_singular' => 'State',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'state_name'        => 'State Name',
            'state_name_helper' => ' ',
            'country'           => 'Country',
            'country_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'address' => [
        'title'          => 'Address',
        'title_singular' => 'Address',
    ],
    'website' => [
        'title'          => 'Website Managements',
        'title_singular' => 'Website Managements',
    ],
    'city' => [
        'title'          => 'Cities',
        'title_singular' => 'City',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'state'             => 'State',
            'state_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'city_name'         => 'City Name',
            'city_name_helper'  => ' ',
        ],
    ],
    'admin' => [
        'title'          => 'Admin Users',
        'title_singular' => 'Admin User',
    ],
    'eventsManagement' => [
        'title'          => 'Trip/Event Management',
        'title_singular' => 'Trip/Event Management',
    ],
    'eventAddon' => [
        'title'          => 'Event Addons',
        'title_singular' => 'Event Addon',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'addon_title'          => 'Addon Title',
            'addon_title_helper'   => ' ',
            'addon_details'        => 'Addon Details',
            'addon_details_helper' => ' ',
            'addon_price'          => 'Addon Price',
            'addon_price_helper'   => ' ',
            'status'               => 'Status',
            'status_helper'        => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
        ],
    ],
    'event' => [
        'title'          => 'Events/Trips Packages',
        'title_singular' => 'Events/Trips Package',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'event_title'           => 'Event Title',
            'event_title_helper'    => ' ',
            'overview'              => 'Overview',
            'overview_helper'       => ' ',
            'duration'              => 'Duration',
            'duration_helper'       => ' ',
            'daily_price'           => 'Price per Person',
            'daily_price_helper'    => ' ',
            'featured_image'        => 'Featured Image',
            'featured_image_helper' => ' ',
            'information'           => 'Information',
            'information_helper'    => ' ',
            'country'               => 'Country',
            'country_helper'        => ' ',
            'state'                 => 'State',
            'state_helper'          => ' ',
            'city'                  => 'City',
            'city_helper'           => ' ',
            'event_start'           => 'Event Start',
            'event_start_helper'    => ' ',
            'event_end'             => 'Event End',
            'event_end_helper'      => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated At',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted At',
            'deleted_at_helper'     => ' ',
            'hotels'                => 'Hotels',
            'hotels_helper'         => ' ',
            'age'                       => 'Age Restrictions',
            'age_helper'                => ' ',
            'addons'                    => 'Addons',
            'addons_helper'             => ' ',
            'amenities_included'        => 'Amenities Included',
            'amenities_included_helper' => ' ',
            'amenities_excluded'        => 'Amenities Excluded',
            'amenities_excluded_helper' => ' ',
            'costumes'        => 'Costumes Included',
            'costumes_helper' => ' ',
        ],
    ],
    'costume' => [
        'title'          => 'Costumes',
        'title_singular' => 'Costume',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'costume_title'          => 'Costume Title',
            'costume_title_helper'   => ' ',
            'costume_details'        => 'Costume Details',
            'costume_details_helper' => ' ',
            'costume_price'          => 'Costume Price',
            'costume_price_helper'   => 'Costume base price',
            'status'                 => 'Status',
            'status_helper'          => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
            'options'                => 'Options',
            'options_helper'         => ' ',
        ],
    ],
    'costumeAttribute' => [
        'title'          => 'Costume Attributes',
        'title_singular' => 'Costume Attribute',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'values'            => 'Values',
            'values_helper'     => 'give predefined options to user for this costume addon',
        ],
    ],
    'eventTicket' => [
        'title'          => 'Event Tickets',
        'title_singular' => 'Event Ticket',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'event'               => 'Event',
            'event_helper'        => ' ',
            'ticket_title'        => 'Ticket Title',
            'ticket_title_helper' => ' ',
            'ticket_date'         => 'Ticket Date',
            'ticket_date_helper'  => ' ',
            'ticket_price'        => 'Ticket Price',
            'ticket_price_helper' => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
        ],
    ],
    'booking' => [
        'title'          => 'Bookings',
        'title_singular' => 'Booking',
    ],
    'eventBooking' => [
        'title'          => 'Event Bookings',
        'title_singular' => 'Event Booking',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'booking_event'          => 'Booking Event',
            'booking_event_helper'   => ' ',
            'booking_by_user'        => 'Booking By User',
            'booking_by_user_helper' => ' ',
            'booking_total'          => 'Booking Total',
            'booking_total_helper'   => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
            'booking_details'        => 'Booking Details',
            'booking_details_helper' => ' ',
            'status'                 => 'Status',
            'status_helper'          => ' ',
        ],
    ],
    'traveler' => [
        'title'          => 'Travelers Details',
        'title_singular' => 'Travelers Detail',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'first_name'        => 'First Name',
            'first_name_helper' => ' ',
            'last_name'         => 'Last Name',
            'last_name_helper'  => ' ',
            'email'             => 'Email',
            'email_helper'      => ' ',
            'phone'             => 'Phone',
            'phone_helper'      => ' ',
            'gender'            => 'Gender',
            'gender_helper'     => ' ',
            'notes'             => 'Notes',
            'notes_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'booking'           => 'Booking',
            'booking_helper'    => ' ',
            'costume'           => 'Costume',
            'costume_helper'    => ' ',
            'tickets'           => 'Tickets',
            'tickets_helper'    => ' ',
        ],
    ],
    'payment' => [
        'title'          => 'Payments',
        'title_singular' => 'Payment',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'payment_event'          => 'Payment Event',
            'payment_event_helper'   => ' ',
            'payment_user'           => 'Payment User',
            'payment_user_helper'    => ' ',
            'payment_booking'        => 'Booking Event',
            'payment_booking_helper' => ' ',
            'amount_total'           => 'Amount Total',
            'amount_total_helper'    => ' ',
            'amount_paid'            => 'Amount Paid',
            'amount_paid_helper'     => ' ',
            'amount_balance'         => 'Amount Balance',
            'amount_balance_helper'  => ' ',
            'payment_method'         => 'Payment Method',
            'payment_method_helper'  => ' ',
            'payment_details'        => 'Payment Details',
            'payment_details_helper' => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
        ],
    ],
    'hotel' => [
        'title'          => 'Hotels',
        'title_singular' => 'Hotel',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'hotel_name'        => 'Hotel Name',
            'hotel_name_helper' => ' ',
            'details'           => 'Details',
            'details_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'amenities'         => 'Amenities',
            'amenities_helper'  => ' ',
        ],
    ],
    'hotelRoom' => [
        'title'          => 'Hotel Rooms',
        'title_singular' => 'Hotel Room',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'hotel'                => 'Hotel',
            'hotel_helper'         => ' ',
            'room_title'           => 'Room Title',
            'room_title_helper'    => ' ',
            'details'              => 'Details',
            'details_helper'       => ' ',
            'room_price'           => 'Room Price',
            'room_price_helper'    => ' ',
            'room_images'           => 'Room Images',
            'room_images_helper'    => ' Multiple Images allowed ',
            'discount_price'           => 'Room Discounted Price',
            'discount_price_helper'    => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
            'room_capacity'        => 'Room Capacity',
            'room_capacity_helper' => '1,2,3 Person',
            'room_quantity'        => 'Room Quantity',
            'room_quantity_helper' => ' ',
        ],
    ],
    'amenity' => [
        'title'          => 'Amenities',
        'title_singular' => 'Amenity',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'icon'              => 'Icon',
            'icon_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'hotelsManagement' => [
        'title'          => 'Hotels Management',
        'title_singular' => 'Hotels Management',
    ],
    'setting' => [
        'title'          => 'Settings',
        'title_singular' => 'Setting',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'name'                 => 'Name',
            'name_helper'          => ' ',
            'setting_key'          => 'Setting Key',
            'setting_key_helper'   => ' ',
            'setting_value'        => 'Setting Value',
            'setting_value_helper' => ' ',
            'details'              => 'Details',
            'details_helper'       => ' ',
            'setting_type'         => 'Setting Type',
            'setting_type_helper'  => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
        ],
    ],
    'testimonial' => [
        'title'          => 'Testimonials/Reviews',
        'title_singular' => 'Testimonials/Review',
        'fields'         => [
            'id'                        => 'ID',
            'id_helper'                 => ' ',
            'review_text'               => 'Review/Testimonial',
            'review_text_helper'        => ' ',
            'ratings'                   => 'Ratings',
            'ratings_helper'            => ' ',
            'user'                      => 'User',
            'user_helper'               => ' ',
            'event_trip_booking'        => 'Event/Trip',
            'event_trip_booking_helper' => ' ',
            'review_date'               => 'Review/Testimonial Date',
            'review_date_helper'        => ' ',
            'featured'                  => 'Featured',
            'featured_helper'           => ' ',
            'created_at'                => 'Created at',
            'created_at_helper'         => ' ',
            'updated_at'                => 'Updated at',
            'updated_at_helper'         => ' ',
            'deleted_at'                => 'Deleted at',
            'deleted_at_helper'         => ' ',
        ],
    ],
    'websiteManagement' => [
        'title'          => 'Website Management',
        'title_singular' => 'Website Management',
    ],
    'bookingRoom' => [
        'title'          => 'Booking Rooms',
        'title_singular' => 'Booking Room',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'room'                     => 'Room',
            'room_helper'              => ' ',
            'booking_for'              => 'Booking For',
            'booking_for_helper'       => ' ',
            'room_booking_rate'        => 'Room Booking Rate',
            'room_booking_rate_helper' => ' ',
            'booking_from'             => 'Booking From',
            'booking_from_helper'      => ' ',
            'booking_to'               => 'Booking To',
            'booking_to_helper'        => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
        ],
    ],
    'packageAmenity' => [
        'title'          => 'Package Amenities',
        'title_singular' => 'Package Amenity',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'icon'              => 'Icon',
            'icon_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'coupon' => [
        'title'          => 'Coupons',
        'title_singular' => 'Coupon',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Coupon Title',
            'title_helper'      => ' ',
             'value'             => 'Coupon Amount/Value',
            'title_helper'      => ' ',
             'code'             => 'Coupon Code',
            'title_helper'      => ' ',
             'expiry'             => 'Coupon Expiry Date',
            'title_helper'      => ' ',
             'minimum_amount'             => 'Minimum Amount Required',
            'title_helper'      => ' ',
            'type'             => 'Coupon Amount/Value Type',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
];

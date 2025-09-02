<?php

declare(strict_types=1);

return [
    'next_page'                        => 'Next',
    'back_page'                        => 'Back',
    'show'                             => 'Show',
    'create'                           => 'Create',
    'edit'                             => 'Edit',
    'delete'                           => 'Delete',
    'back'                             => 'Back',
    'submit'                           => 'Submit',
    'cancel'                           => 'Cancel',

    'please_select_an_option'          => 'Please select an option',
    'yes'                              => 'Yes',
    'no'                               => 'No',

    'model_has_stored_successfully'    => ':model has been stored successfully',
    'model_has_updated_successfully'   => ':model has been updated successfully',
    'model_has_deleted_successfully'   => ':model has been deleted successfully',
    'model_has_toggled_successfully'   => ':model has been toggled successfully',
    'model_has_upload_successfully'    => ':model has been uploaded successfully',
    'model_has_Failed_to_upload'       => ':model has failed to upload',
    'model_has_retrieved_successfully' => ':model has been retrieved successfully',
    'model_has_Failed_to_store'        => ':model has failed to store',
    'store_success'                    => 'Store :model successfully',
    'store_failed'                     => 'Store :model failed, please report the problem',
    'update_success'                   => 'Update :model successfully',
    'update_failed'                    => 'Update :model failed, please report the problem',
    'delete_success'                   => 'Delete :model successfully',
    'delete_failed'                    => 'Delete :model failed, please report the problem',
    'delete_can_not'                   => 'You do not have permission to delete :model',
    'toggle_success'                   => 'Toggle :model successfully',
    'toggle_failed'                    => 'Toggle :model failed, please report the problem',
    'toggle_can_not'                   => 'You do not have permission to toggle :model',
    'like_add'                         => 'Like store success',
    'like_remove'                      => 'Like removed',
    'to_do_action_please_login'        => 'Please login to handle action',
    'menu'                             => [
        'index' => ':model s',
    ],

    'page'                             => [
        'index'  => [
            'page_title' => ':model s',
            'title'      => 'All :model',
            'desc'       => 'All :model',
            'create'     => 'Create :model',
        ],
        'create' => [
            'page_title' => 'Create :model',
            'title'      => 'Create :model',
            'desc'       => 'Please be sure to get the approval of the person in charge of content production to register a new item',
        ],
        'edit'   => [
            'page_title' => 'Edit :model',
            'title'      => 'Edit :model',
            'desc'       => 'Please be sure to have the approval of the person responsible for content production to edit this item',
        ],
        'show'   => [
            'page_title' => 'Details :model',
            'title'      => ':model :name',
            'desc'       => 'Details of :model :name',
        ],
    ],
];

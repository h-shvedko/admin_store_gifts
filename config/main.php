<?php
return array(
	'modules'=>array(
        'admin' => array(
            'modules' => array(
                'storegifts' => array(
									
				)
            ),
			 
        ),
	),
    'components' => array(
        'request' => array(
            'noCsrfValidationRoutes' => array(
                'admin/storegifts/Ajaxstoregifts/GetGiftsHorders',
                'admin/storegifts/Ajaxstoregifts/CreateGiftsHorder',
				'admin/storegifts/Ajaxstoregifts/UpdateGiftsHorder',
				'admin/storegifts/Ajaxstoregifts/GetGiftsProducts',
				'admin/storegifts/Ajaxstoregifts/CreateGiftsProduct',
				'admin/storegifts/Ajaxstoregifts/UpdateGiftsProducts',
				'admin/storegifts/Ajaxstoregifts/DeleteGiftsProducts',
				'admin/storegifts/Ajaxstoregifts/ViewGiftsProducts',
				'admin/storegifts/Ajaxstoregifts/CreateGiftsProducts',
				'admin/storegifts/Ajaxstoregifts/uploadFiles',
				'admin/storegifts/Ajaxstoregifts/DeleteAttachmentsProducts',
				'admin/storegifts/Ajaxstoregifts/UpdateMainProducts',
				'admin/storegifts/Ajaxordergifts/GetGiftsHorders',
				'admin/storegifts/Ajaxordergifts/UpdateGiftsHorders',
				'admin/storegifts/Ajaxordergifts/ViewGiftsHorders',
            ),
        ),
    )

);
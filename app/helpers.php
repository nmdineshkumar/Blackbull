<?php

    function getActionButtons( $id, $baseUrl, $types ) {
        $actionBtn = '';
        $actionBtn = '';
        if ( in_array( 'edit', $types ) ) {
            $actionBtn .= "<a href='" . route( $baseUrl.'.edit', $id ) ."' title='Edit the data' class='btn btn-icon btn-color-primary'><i class='fas fa-edit'></i></a>";
        }
        if ( in_array( 'Invocieview', $types ) ) {
            $actionBtn .= "<a href='" . route('getInvoice',$id) ."' title='Preview' class='btn btn-icon btn-color-primary'><i class='fas fa-eye'></i></a>";
        }
        if ( in_array( 'delete', $types ) ) {
            $actionBtn .= "<a href='javascript:;'  data-action-type='delete' data-url='" . route( $baseUrl. '.destroy', $id ) ."' title='Delete the data' class='btn btn-icon btn-color-danger delete-by-id'><i class='fas fa-trash'></i></a>";
        }
        if ( in_array( 'retrieve', $types ) ) {
            $actionBtn .= "<a href='javascript:;'  data-action-type='retrieve' data-url='" . route( $baseUrl. '.destroy', [$id,'retrieve'=>1] ) ."' title='Retrieve the data' class='btn btn-icon btn-color-success delete-by-id'><i class='fas fa-trash-restore-alt'></i></a>";
        }
        if ( in_array( 'payment', $types ) ) {
            $actionBtn .= "<a href='" . route( $baseUrl. '.addPayment', $id ) ."' title='Add Payment' class='btn btn-icon btn-color-success'><i class='fas fa-money-bill-alt'></i></i></a>";
        }
        return $actionBtn;
    }
    function getRandomSting(): string {
        return time() . '-' . uniqid();
    }

    function getRandomFileName( $extension ): string {
        return getRandomSting() . '.' . $extension;
    }
    function getFileDisk() {
        return env( 'APP_FILE_DISK', 'public' );
    }
    function getS3FullUrl( $relativePath ): string {
        if ( getFileDisk() == 'public' ) {
            return asset( 'storage/'.$relativePath );
        } else {
            return s3BaseUrl() . ( string )$relativePath;
        }
    }
    function paymentTypes(): array {
        return [
            ( object )[ 'id' => 1, 'name' =>'Cheque'], 
            ( object )[ 'id' => 2, 'name' =>'Online'], 
            ( object )[ 'id' => 3, 'name' =>'Cash' ], 
            ( object )[ 'id' => 4, 'name' =>'Credit Card']
        ];
    }
    function get_PaymentTypes($id):string{
        $name = "";
        foreach(paymentTypes() as $row){
            if($id == $row->id){
                $name = $row->name;
            }
        }
        return $name;
    }
    function statusOptions(): array {
        return [
            ( object )[ 'id' => 1, 'name' => 'Active', 'class'=>'success' ],
            ( object )[ 'id' => 0, 'name' => 'Inactive', 'class'=>'danger' ]
        ];
    }
    function SaleType(): array {
        return [
            ( object )[ 'id' => 1, 'name' => 'Online', 'class'=>'success' ],
            ( object )[ 'id' => 2, 'name' => 'Offline', 'class'=>'danger' ]
        ];
    }
    function SaleTypeGetById($id): string{
        $name = '';
        foreach ( SaleType() as $s =>$value ) {
            if ( intval($value->id) === intval($id) ) {
                $name = $value->name;
            }
        }
        return $name;
    }
    function tyreType(): array {
        return [
            ( object )[ 'id' => 1, 'name' => 'TTF'],
            ( object )[ 'id' => 2, 'name' => 'TL']
        ];
    }
    function carFuelType(): array {
        return [
            ( object )[ 'id' => 1, 'name' => 'Petrol'],
            ( object )[ 'id' => 2, 'name' => 'Diesel'],
            ( object )[ 'id' => 3, 'name' => 'Gas']
        ];
    }
    function getStatus( $id ) {
        $name = '';
        foreach ( StatusOptions() as $s =>$value ) {
            if ( intval($value->id) === intval($id) ) {
                $name = "<div class='badge badge-light-".$value->class."'>".$value->name.'</div>';
            }
        }
        return $name;
    }
    function purchase_type():array{
        return [
            (object)['id'=>'1','name'=>'Regular'],
            (object)['id'=>'2','name'=>'Third Party']
        ];
    }
    function website_visible():array{
        return [
            (object)['id'=>'1','name'=>'Enable'],
            (object)['id'=>'0','name'=>'disable']
        ];
    }
    function get_Puchase_type($id){
        $type = "";
        foreach(purchase_type() as $row){
            if($row->id = $id){
                $type = $row->name;
            }
        }
        return $type;
    }
    function InvoiceTemplate():array{
        return [
            (object)['id'=>"1",'name'=>'Omen','url'=>'omanInvoice'],
            (object)['id'=>'2', 'name'=>'Dubai','url'=>'dubaiInvoice']
        ];
    }
    function getInvoiceTemplate($id){
        $name = '';
        foreach(InvoiceTemplate() as $row){
            if($id == $row->id){
                $name = $row->url;
            }
        }
        return $name;
    }

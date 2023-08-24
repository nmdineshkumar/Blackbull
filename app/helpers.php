<?php

    function getActionButtons( $id, $baseUrl, $types ) {
        $actionBtn = '';
        $actionBtn = '';
        if ( in_array( 'edit', $types ) ) {
            $actionBtn .= "<a href='" . route( $baseUrl.'.edit', $id ) ."' title='Edit the data' class='btn btn-icon btn-color-primary'><i class='fas fa-edit'></i></a>";
        }
        if ( in_array( 'delete', $types ) ) {
            $actionBtn .= "<a href='javascript:;'  data-action-type='delete' data-url='" . route( $baseUrl. '.destroy', $id ) ."' title='Delete the data' class='btn btn-icon btn-color-danger delete-by-id'><i class='fas fa-trash'></i></a>";
        }
        if ( in_array( 'retrieve', $types ) ) {
            $actionBtn .= "<a href='javascript:;'  data-action-type='retrieve' data-url='" . route( $baseUrl. '.destroy', [$id,'retrieve'=>1] ) ."' title='Retrieve the data' class='btn btn-icon btn-color-success delete-by-id'><i class='fas fa-trash-restore-alt'></i></a>";
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
    function get_Puchase_type($id){
        $type = "";
        foreach(purchase_type() as $row){
            if($row->id = $id){
                $type = $row->name;
            }
        }
        return $type;
    }

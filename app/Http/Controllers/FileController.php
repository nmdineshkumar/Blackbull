<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    //
    public function saveImage( Request $request ) {
        $validFormats = ( $request->accept != null ) ? explode( ',', $request->accept ) : array();
        $i = ( $request->file( 'file1' ) ) ? 1 :( ( $request->file( 'file2' ) ) ? 2 :3 );
        $file = $request->file( 'file'.$i );
        if ( isset( $file ) && $file ) {
            $extension = $file->getClientOriginalExtension();
            $size = $file->getSize();
            if ( count( $validFormats )>0 &&  !in_array( strtolower( $extension ), $validFormats ) ) {
                return response( json_encode( array( 'hasWarnings' => true, 'isSuccess' => false, 'warnings' => [ 'Only '.implode( ', ', $validFormats ).' file types are allowed' ] ) ), 500 );
            } else if ( $size > ( 3 * 1024 * 1024 ) ) {
                return response( json_encode( array( 'hasWarnings' => true, 'isSuccess' => false, 'warnings' => [ 'Please try again' ], 'error' => 'The maximum file size allowed 3 MB' ) ));
            } else {
                $fileName = (isset($_GET[ 'original_fine_name' ]) && $_GET['original_fine_name']) ? $file->getClientOriginalName() : getRandomFileName( $extension );
                $relativePath = $_GET[ 'path' ] .'/' . $fileName;
                Storage::disk( getFileDisk() )->put( $relativePath, file_get_contents( $file ), 'public' );
                if(isset($_GET[ 'is_thumb' ]) && $_GET['is_thumb']){
                    $this->createThumbnail($_GET[ 'path' ], $fileName);
                    return response( json_encode( array( 'filename' => $fileName ) ));
                }else{
                    return response( json_encode( array( 'filename' => $fileName ) ));
                }
            }
        }
    }

    public function saveMultipleImage( Request $request ) { 
        $validFormats = ( $request->accept != null ) ?  explode( ',', $request->accept ) : array();
        $i = ( $request->file( 'files1' ) ) ? 1 :( ( $request->file( 'files2' ) ) ? 2 :3 );
        $files = $request->file( 'files'.$i );
        if ( isset( $files ) && $files ) {
            $file = $files[ 0 ];
            $extension = $file->getClientOriginalExtension();
            $size = $file->getSize();
            if ( count( $validFormats )>0 &&  !in_array( strtolower( $extension ), $validFormats ) ) {
                return response( json_encode( array( 'hasWarnings' => true, 'isSuccess' => false, 'warnings' => [ 'Only '.implode( ', ', $validFormats ).' file types are allowed' ] ) ), 500 );
            } else if ( $size > ( 3 * 1024 * 1024 ) ) {
                return response( json_encode( array( 'hasWarnings' => true, 'isSuccess' => false, 'warnings' => [ 'Please try again' ], 'error' => 'The maximum file size allowed 3 MB' ) ));
            } else {
                $fileName = getRandomFileName( $extension );
                $relativePath = $_GET[ 'path' ] .'/' . $fileName;
                Storage::disk( getFileDisk())->put( $relativePath, file_get_contents( $file ), 'public' );
                return response( json_encode( array( 'filename' => $fileName ) ) );
            }
        }
    }

    public function deleteImage() {
        if(isset($_GET[ 'is_thumb' ]) && $_GET['is_thumb']){
            Storage::disk( getFileDisk() )->delete( $_GET[ 'path' ].'/thumb/' . $_POST[ 'file' ] );
         } 
        if ( isset( $_GET[ 'path' ] ) && $_GET[ 'path' ] ) {
            Storage::disk( getFileDisk() )->delete( $_GET[ 'path' ].'/' . $_POST[ 'file' ] );
        } else {
            Storage::disk( getFileDisk() )->delete( 'category/' . $_POST[ 'file' ] );
        }
        $value = array(
            'result' => 'Success'
        );
        echo json_encode( $value );
    }

    // public function createThumbnail($path, $fileName){
    //     ini_set('memory_limit', '512M');
    //     $basePath= $path;
    //     if(getFileDisk()=='public'){
    //         $path = public_path('storage/'.$path .'/'.$fileName);
    //     }else{
    //         $path = Storage::disk(getFileDisk())->url($path .'/'.$fileName);
    //     }
    //     $thumbnailRelativePath = $basePath ."/thumb/".$fileName;
    //     $small = Image::make($path)->resize(Blog::IMAGE_RESIZE_WIDTH, Blog::IMAGE_RESIZE_HEIGHT, function ($constraint) {
    //         $constraint->aspectRatio();
    //     });
    //     Storage::disk(getFileDisk())->put($thumbnailRelativePath, $small->stream()->__toString(), 'public');
    // }
}

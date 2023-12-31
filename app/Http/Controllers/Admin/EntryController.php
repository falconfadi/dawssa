<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    public $entries;
    public function __construct()
    {
        $this->entries = ['1'=>'sanad_mulkieh','2'=>'nearest_water_bill','3'=>'transform_possession_paper'];
    }

    public function sanad_mulkieh(){
        $output = '<div class="col-md-12">
                            <div class="form-group">
                                <label for="customFile">سند ملكية</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="i1" name="i1">
                                    <label class="custom-file-label" for="i1">Choose file</label>
                                </div>
                            </div>
                         </div>';
        return $output;
    }

    public function nearest_water_bill(){
        $output = '<div class="col-md-12">
                            <div class="form-group">
                                <label for="customFile">فاتورة مياه لمشترك قريب </label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="i2" name="i2">
                                    <label class="custom-file-label" for="i2">Choose file</label>
                                </div>
                            </div>
                         </div>';
        return $output;
    }

    public function transform_possession_paper(){
        $output = '<div class="col-md-12">
                            <div class="form-group">
                                <label for="customFile">ورقة نقل ملكية</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="i3" name="i3">
                                    <label class="custom-file-label" for="i3">Choose file</label>
                                </div>
                            </div>
                         </div>';
        return $output;
    }
}

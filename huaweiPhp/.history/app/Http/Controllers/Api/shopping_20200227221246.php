<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;

class shopping extends Controller
{
    //获取用户/管理员的数据
    public function User(Request $request){
        $gradeIf = $request->get('gradeIf');
        if($gradeIf == 0){
            $data = \App\Home\user::where('user_Grade','<','6')->get();
        }else if($gradeIf == 1){
            $data = \App\Home\user::where('user_Grade','=','6')->get();
        }
        echo $data;
    }

    //获取商品信息
    public function goodsInfo(){
        $data = \App\Home\goodsInfo::get();
        echo $data;
    }

    //获取订单详情信息
    public function ordersDetailed(){
        $data = \App\Home\ordersDetailed::get();
        echo $data;
    }

    //获取进货信息
    public function purchaseInfo(){
        $data = \App\Home\purchaseInfo::get();
        echo $data;
    }

    //获取商品详情信息
    public function goodsDetailed(){
        $data = \App\Home\goodsDetailed::where('goods_status','!=','2')->get();
        echo $data;
    }

    //用户/管理员登陆验证
    public function Login(Request $request){
        $account = $request->get('account');
        $password = $request->get('password');
        $loginIf = $request->get('loginIf');
        $msg = '';
        if($loginIf == 0){
            $data = \App\Home\user::where('user_Grade','<','6')->get();
            foreach($data as $key => $value){
                if($value->user_account == $account){
                    if($value->user_password == $password){
                        $msg = 0;
                        break;
                    }else{
                        $msg = 2;
                        break;
                    }
                }else{
                    $msg = 1;
                }
            }
        }else if($loginIf == 1){
            $data = \App\Home\user::where('user_Grade','=','6')->get();
            foreach($data as $key => $value){
                if($value->user_account == $account){
                    if($value->user_password == $password){
                        $msg = 0;
                        break;
                    }else{
                        $msg = 2;
                        break;
                    }
                }else{
                    $msg = 1;
                }
            }
        }
        echo $msg;
    }

    //用户/管理员注册
    public function Register(Request $request){
        $account = $request->get('account');
        $password = $request->get('password');
        $email = $request->get('email');
        $registerIf = $request->get('registerIf');
        $msg = '';
        if($registerIf == 0){
            $data = \App\Home\user::where('user_Grade','<','6')->get();
            foreach($data as $key => $value){
                if($value->user_account == $account){
                    $msg = 1;
                    break;
                }else{
                    if($value->user_email == $email){
                        $msg = 2;
                        break;
                    }
                }
            }
            if($msg == '' || $msg == null){
                $data = DB::insert("insert into user(user_account,user_password,user_email,user_pay,user_address_id,user_Grade) 
                values(?,?,?,?,?,?)",[$account,$password,$email,0,0,0]);
                $msg = 0;
            }
        }else if($registerIf == 1){
            $data = \App\Home\user::where('user_Grade','=','6')->get();
            foreach($data as $key => $value){
                if($value->user_account == $account){
                    $msg = 1;
                    break;
                }else{
                    if($value->user_email == $email){
                        $msg = 2;
                        break;
                    }
                }
            }
            if($msg == '' || $msg == null){
                $data = DB::insert("insert into user(user_account,user_password,user_email,user_pay,user_address_id,user_Grade) 
                values(?,?,?,?,?,?)",[$account,$password,$email,0,0,6]);
                $msg = 0;
            }
        }
        echo $msg;
    }

    //修改用户/管理员信息
    public function updateUser(Request $request){
        $account = $request->get('account');
        $password = $request->get('password');
        $email = $request->get('email');
        $updateIf = $request->get('updateIf');
        $msg = '';
        if($updateIf == 1){
            $data = \App\Home\user::where('user_email','=',$email)->where('user_Grade','=','6')->get();
            if(count($data) == 1){
                $msg = 2;
            }else{
                $data = \App\Home\user::where('user_account','=',$account)->where('user_Grade','=','6')->update([
                    'user_password' => $password,
                    'user_email' => $email
                ]);
                if($data == 1){
                    $msg = 1;
                }else{
                    $msg = 0;
                }
            }
        }else{
            $data = \App\Home\user::where('user_email','=',$email)->where('user_Grade','<','6')->get();
            if(count($data) == 1){
                $msg = 2;
            }else{
                $data = \App\Home\user::where('user_account','=',$account)->where('user_Grade','<','6')->update([
                    'user_password' => $password,
                    'user_email' => $email
                ]);
                if($data == 1){
                    $msg = 1;
                }else{
                    $msg = 0;
                }
            }
        }
        echo $msg;
    }

    //注销用户/管理员
    public function delUser(Request $request){
        $account = $request->get('account');
        $msg = '';
        $data = \App\Home\user::where('user_account','=',$account)->update([
            'user_Grade' => '7'
        ]);
        if($data == 1){
            $msg = 1;
        }else{
            $msg = 0;
        }
        echo $msg;
    }

    //添加商品
    public function goodsAdd(Request $request){
        $name = $request->get('name');
        $title = $request->get('title');
        $category = $request->get('category');
        $msg = '';
        $data = DB::insert("insert into goods_info(goods_info_name,goods_info_title,goods_category) 
        values(?,?,?)",[$name,$title,$category]);
        if($data == 1){
            $msg = 1;
        }else{
            $msg = 0;
        }
        echo $msg;
    }

    //修改商品信息
    public function goodsUpd(Request $request){
        $id = $request->get('id');
        $name = $request->get('name');
        $title = $request->get('title');
        $category = $request->get('category');
        $status = $request->get('status');
        $msg = '';
        $data = \App\Home\goodsInfo::where('goods_info_id','=',$id)->update([
            'goods_info_name' => "$name",
            'goods_info_title' => "$title",
            'goods_category' => "$category",
            'goods_info_status' => "$status"
        ]);
        if($data == 1){
            $msg = 1;
        }else{
            $msg = 0;
        }
        echo $msg;
    }
    
    //根据商品ID获取详情信息
    public function selectGD(Request $request){
        $id = $request->get('id');
        $data = \App\Home\goodsDetailed::where('goods_info_id','=',$id)->where('goods_status','!=','2')->get();
        echo $data;
    }

    //添加goods商品
    public function addGD(Request $request){
        $id = $request->get('id');
        $no = $request->get('no');
        $color = $request->get('color');
        $configure = $request->get('configure');
        $price = $request->get('price');
        $status = $request->get('status');
        $msg = '';
        $data = \App\Home\goods::where('goods_no','=',$no)->get();
        if(count($data) > 0){
            $msg = 2;
        }else{
            $data = DB::insert("insert into goods(goods_no,goods_info_id,goods_color,goods_configure,goods_price,goods_status) 
            values(?,?,?,?,?,?)",[$no,$id,$color,$configure,$price,$status]);
            if($data == 1){
                $msg = 1;
            }else{
                $msg = 0;
            }
        }
        echo $msg;
    }

    //修改goods商品
    public function updGD(Request $request){
        $no = $request->get('no');
        $color = $request->get('color');
        $configure = $request->get('configure');
        $price = $request->get('price');
        $status = $request->get('status');
        $msg = '';
        $data = \App\Home\goods::where('goods_no','=',$no)->get();
        if(count($data) > 0){
            $data = \App\Home\goods::where('goods_no','=',$no)->update([
                'goods_color' => "$color",
                'goods_configure' => "$configure",
                'goods_price' => "$price",
                'goods_status' => "$status"
            ]);
            if($data == 1){
                $msg = 1;
            }else{
                $msg = 0;
            }
        }else{
            $msg = 2;
        }
        echo $msg;
    }

    //根据商品NO获取详情信息
    public function selectGN(Request $request){
        $no = $request->get('no');
        $data = \App\Home\goodsDetailed::where('goods_no','=',$no)->where('goods_status','!=','2')->get();
        echo $data;
    }

    //添加进货信息
    public function goodsPurchase(Request $request){
        $id = $request->get('id');
        $num = $request->get('num');
        $price = $request->get('price');
        $msg = '';
        $data = DB::insert("insert into purchase(stock_id,purchase_num,purchase_price) 
        values(?,?,?)",[$id,$num,$price]);
        if($data == 1){
            $msg = 1;
        }else{
            $msg = 0;
        }
        echo $msg;
    }

    //撤销进货订单
    public function revokePurchase(Request $request){
        $id = $request->get('id');
        $reason = $request->get('reason');
        $msg = '';
        $data = \App\Home\purchase::where('purchase_id','=',$id)->update([
            'purchase_status' => 0,
            'revokeReason' => "$reason"
        ]);
        if($data == 1){
            $msg = 1;
        }else{
            $msg = 0;
        }
        echo $msg;
    }

    //上传商品流览图
    public function browsePicture(Request $request){
        $no = $request->input('no');
        $order = $request->input('order');
        $filename = $_FILES['myFile']['name'];
        $type = $_FILES['myFile']['type'];
        $tmp_name = $_FILES['myFile']['tmp_name'];
        $error = $_FILES['myFile']['error'];
        $size = $_FILES['myFile']['size'];
        $allowExt = array("gif","jpeg","jpg","png","wbmp");
        $maxSize = 1048576;
        //判断错误信息
        if($error == UPLOAD_ERR_OK){
            //判断文件是否通过HTTP POST方式上传上来的
            //获取文件扩展名
            $ext = substr(strrchr($filename,'.'), 1);
            $filename = md5(uniqid(microtime(true),true)).".".$ext;
            //限制上传文件类型
            if(!in_array($ext,$allowExt)){
                exit("非法文件类型");
            }
            //限制文件大小
            if($size>$maxSize){
                exit("文件过大");
            }
            $destination = 'D:\HuaWeiShopping\huaweiVue\static\image/'.$filename;
            if(is_uploaded_file($tmp_name)){
                if(move_uploaded_file($tmp_name,$destination)){
                    $data = \App\Home\browsePicture::where('goods_no','=',$no)->where('browse_picture_order','=',$order)->get();
                    if(count($data) > 0){
                        $data = \App\Home\browsePicture::where('goods_no','=',$no)->where('browse_picture_order','=',$order)->update([
                            'browse_picture_name' => "$filename"
                        ]);
                    }else{
                        $data = DB::insert("insert into browse_picture(goods_no,browse_picture_order,browse_picture_name) values(?,?,?)",[
                            $no,$order,$filename
                        ]);
                    }
                    $mes = "文件上传成功";
                }else{
                    $mes = "文件移动失败";
                }
            }else{
                $mes = "文件不是通过HTTP POST方式上传上来的";
            }
        }else{
            switch($error){
                case 1:
                    $mes = "超过了配置文件上传文件的大小"; //UPLOAD_ERR_INI_SIZE
                    break;
                case 2:
                    $mes = "超过了表单设置上传文件的大小"; //UPLOAD_ERR_FORM_SIZE
                    break;
                case 3:
                    $mes = "文件部分被上传"; //UPLOAD_ERR_PATH
                    break;
                case 4:
                    $mes = "没有文件被上传"; //UPLOAD_ERR_NO_FILE
                    break;
                case 6:
                    $mes = "没有找到临时目录"; //UPLOAD_ERR_TMP_DIR
                    break;
                case 7:
                    $mes = "文件不可写"; //UPLOAD_ERR_CANT_WRITE
                    break;
                case 8:
                    $mes = "由于PHP的扩展程序中断了文件上传"; //UPLOAD_ERR_EXTENSION
                    break;
            }
        }
    }

    //根据商品编号获取商品流览图信息
    public function selectBrowse(Request $request){
        $no = $request->get('no');
        $data = \App\Home\browsePicture::where('goods_no','=',$no)->get();
        echo $data;
    }

    //上传商品详情图
    public function detailedPicture(Request $request){
        $id = $request->input('id');
        $order = $request->input('order');
        $filename = $_FILES['myFile']['name'];
        $type = $_FILES['myFile']['type'];
        $tmp_name = $_FILES['myFile']['tmp_name'];
        $error = $_FILES['myFile']['error'];
        $size = $_FILES['myFile']['size'];
        $allowExt = array("gif","jpeg","jpg","png","wbmp");
        $maxSize = 1048576;
        //判断错误信息
        if($error == UPLOAD_ERR_OK){
            //判断文件是否通过HTTP POST方式上传上来的
            //获取文件扩展名
            $ext = substr(strrchr($filename,'.'), 1);
            $filename = md5(uniqid(microtime(true),true)).".".$ext;
            //限制上传文件类型
            if(!in_array($ext,$allowExt)){
                exit("非法文件类型");
            }
            //限制文件大小
            if($size>$maxSize){
                exit("文件过大");
            }
            $destination = 'D:\HuaWeiShopping\huaweiVue\static\image/'.$filename;
            if(is_uploaded_file($tmp_name)){
                if(move_uploaded_file($tmp_name,$destination)){
                    $data = \App\Home\goodsPicture::where('goods_info_id','=',$id)->where('goods_picture_order','=',$order)->get();
                    if(count($data) > 0){
                        $data = \App\Home\goodsPicture::where('goods_info_id','=',$id)->where('goods_picture_order','=',$order)->update([
                            'goods_picture_name' => "$filename"
                        ]);
                    }else{
                        $data = DB::insert("insert into goods_picture(goods_info_id,goods_picture_order,goods_picture_name) 
                        values(?,?,?)",[$id,$order,$filename]);
                    }
                    $mes = "文件上传成功";
                }else{
                    $mes = "文件移动失败";
                }
            }else{
                $mes = "文件不是通过HTTP POST方式上传上来的";
            }
        }else{
            switch($error){
                case 1:
                    $mes = "超过了配置文件上传文件的大小"; //UPLOAD_ERR_INI_SIZE
                    break;
                case 2:
                    $mes = "超过了表单设置上传文件的大小"; //UPLOAD_ERR_FORM_SIZE
                    break;
                case 3:
                    $mes = "文件部分被上传"; //UPLOAD_ERR_PATH
                    break;
                case 4:
                    $mes = "没有文件被上传"; //UPLOAD_ERR_NO_FILE
                    break;
                case 6:
                    $mes = "没有找到临时目录"; //UPLOAD_ERR_TMP_DIR
                    break;
                case 7:
                    $mes = "文件不可写"; //UPLOAD_ERR_CANT_WRITE
                    break;
                case 8:
                    $mes = "由于PHP的扩展程序中断了文件上传"; //UPLOAD_ERR_EXTENSION
                    break;
            }
        }
    }

    //根据商品ID获取商品详情图信息
    public function selectDetailed(Request $request){
        $id = $request->get('id');
        $data = \App\Home\goodsPicture::where('goods_info_id','=',$id)->get();
        echo $data;
    }

    //获取轮播图信息
    public function carouselInfo(){
        $data = \App\Home\carousel::get();
        echo $data;
    }

    //上传轮播图信息
    public function carouselUpload(Request $request){
        $order = $request->input('order');
        $id = $request->input('id');
        $title = $request->input('title');

        $picname = $_FILES['pic']['name'];
        $pictype = $_FILES['pic']['type'];
        $pictmp_name = $_FILES['pic']['tmp_name'];
        $picerror = $_FILES['pic']['error'];
        $picsize = $_FILES['pic']['size'];

        $minname = $_FILES['min']['name'];
        $mintype = $_FILES['min']['type'];
        $mintmp_name = $_FILES['min']['tmp_name'];
        $minerror = $_FILES['min']['error'];
        $minsize = $_FILES['min']['size'];

        $allowExt = array("gif","jpeg","jpg","png","wbmp");
        $maxSize = 1048576;
        //判断错误信息
        if($picerror == UPLOAD_ERR_OK){
            //判断文件是否通过HTTP POST方式上传上来的
            //获取文件扩展名
            $picext = substr(strrchr($picname,'.'), 1);
            $picname = md5(uniqid(microtime(true),true)).".".$picext;

            //限制上传文件类型
            if(!in_array($picext,$allowExt)){
                exit("非法文件类型");
            }
            //限制文件大小
            if($picsize>$maxSize){
                exit("文件过大");
            }

            $picdestination = 'D:\HuaWeiShopping\huaweiVue\static\image/'.$picname;

            if(is_uploaded_file($pictmp_name)){
                if(move_uploaded_file($pictmp_name,$picdestination)){
                    if($minerror == UPLOAD_ERR_OK){
                        //判断文件是否通过HTTP POST方式上传上来的
                        //获取文件扩展名
                        $minext = substr(strrchr($minname,'.'), 1);
                        $minname = md5(uniqid(microtime(true),true)).".".$minext;
                        //限制上传文件类型
                        if(!in_array($minext,$allowExt)){
                            exit("非法文件类型");
                        }
                        //限制文件大小
                        if($minsize>$maxSize){
                            exit("文件过大");
                        }
            
                        $mindestination = 'D:\HuaWeiShopping\huaweiVue\static\image/'.$minname;
            
                        if(is_uploaded_file($mintmp_name)){
                            if(move_uploaded_file($mintmp_name,$mindestination)){
                                $data = \App\Home\carousel::where('carousel_id','=',$order)->update([
                                    'carousel_name' => "$picname",
                                    'min_carousel' => "$minname",
                                    'carousel_title' => "$title",
                                    'goods_info_id' => "$id",
                                ]);
                                $mes = "文件上传成功";
                            }else{
                                $mes = "文件移动失败";
                            }
                        }else{
                            $mes = "文件不是通过HTTP POST方式上传上来的";
                        }
                    }else{
                        switch($minerror){
                            case 1:
                                $mes = "超过了配置文件上传文件的大小"; //UPLOAD_ERR_INI_SIZE
                                break;
                            case 2:
                                $mes = "超过了表单设置上传文件的大小"; //UPLOAD_ERR_FORM_SIZE
                                break;
                            case 3:
                                $mes = "文件部分被上传"; //UPLOAD_ERR_PATH
                                break;
                            case 4:
                                $mes = "没有文件被上传"; //UPLOAD_ERR_NO_FILE
                                break;
                            case 6:
                                $mes = "没有找到临时目录"; //UPLOAD_ERR_TMP_DIR
                                break;
                            case 7:
                                $mes = "文件不可写"; //UPLOAD_ERR_CANT_WRITE
                                break;
                            case 8:
                                $mes = "由于PHP的扩展程序中断了文件上传"; //UPLOAD_ERR_EXTENSION
                                break;
                        }
                    }
                }else{
                    $mes = "文件移动失败";
                }
            }else{
                $mes = "文件不是通过HTTP POST方式上传上来的";
            }
        }else{
            switch($picerror){
                case 1:
                    $mes = "超过了配置文件上传文件的大小"; //UPLOAD_ERR_INI_SIZE
                    break;
                case 2:
                    $mes = "超过了表单设置上传文件的大小"; //UPLOAD_ERR_FORM_SIZE
                    break;
                case 3:
                    $mes = "文件部分被上传"; //UPLOAD_ERR_PATH
                    break;
                case 4:
                    $mes = "没有文件被上传"; //UPLOAD_ERR_NO_FILE
                    break;
                case 6:
                    $mes = "没有找到临时目录"; //UPLOAD_ERR_TMP_DIR
                    break;
                case 7:
                    $mes = "文件不可写"; //UPLOAD_ERR_CANT_WRITE
                    break;
                case 8:
                    $mes = "由于PHP的扩展程序中断了文件上传"; //UPLOAD_ERR_EXTENSION
                    break;
            }
        }
    }

    //获取指定订单详情信息
    public function selectOD(Request $request){
        $no = $request->get('no');
        $data = \App\Home\ordersDetailed::where('orders_no','=',$no)->get();
        echo $data;
    }

    //根据物流单号查询物流信息
    public function selectShipping(Request $request){
        $no = $request->get('no');
        $data = \App\Home\shippingInfo::where('shipping_order_no','=',$no)->get();
        echo $data;
    }

    //根据订单编号获取订单商品信息
    public function ordersGoods(Request $request){
        $no = $request->get('no');
        $data = \App\Home\ordersGoods::where('orders_no','=',$no)->get();
        echo $data;
    }

    //订单发货操作
    public function deliverGoods(Request $request){
        $no = $request->get('no');
        $msg = '';
        $data = \App\Home\orders::where('orders_no','=',$no)->update([
            'orders_status' => "3"
        ]);
        if($data == 1){
            $msg = 1;
        }else{
            $msg = 0;
        }
        echo $msg;
    }

    //订单取消操作
    public function cancelOrders(Request $request){
        $no = $request->get('no');
        $msg = '';
        $data = \App\Home\orders::where('orders_no','=',$no)->update([
            'orders_status' => "2"
        ]);
        if($data == 1){
            $msg = 1;
        }else{
            $msg = 0;
        }
        echo $msg;
    }

    //订单商品退款成功操作
    public function refundTrue(Request $request){
        $id = $request->get('id');
        $msg = '';
        $data = \App\Home\shopcar::where('shopcar_id','=',$id)->update([
            'shopcar_status' => "8"
        ]);
        if($data == 1){
            $msg = 1;
        }else{
            $msg = 0;
        }
        echo $msg;

    }

    //订单商品退款失败操作
    public function refundFalse(Request $request){
        $id = $request->get('id');
        $msg = '';
        $data = \App\Home\shopcar::where('shopcar_id','=',$id)->update([
            'shopcar_status' => "6"
        ]);
        if($data == 1){
            $msg = 1;
        }else{
            $msg = 0;
        }
        echo $msg;

    }

    //获取搜索商品详情信息
    public function searchDetailed(){
        $data = \App\Home\searchDetailed::get();
        echo $data;
    }

    //根据用户账号获取用户信息
    public function userInfo(Request $request){
        $account = $request->get('account');
        $data = \App\Home\user::where('user_account','=',$account)->where('user_Grade','<','6')->get();
        echo $data;
    }

    //冲值用户余额
    public function addMoney(Request $request){
        $money = $request->get('money');
        $account = $request->get('account');
        $data = \App\Home\user::where('user_account','=',$account)->where('user_Grade','<','6')->select('user_money')->get();
        $money = $money + $data[0]->user_money;
        $data = \App\Home\user::where('user_account','=',$account)->where('user_Grade','<','6')->update([
            'user_money' => "$money"
        ]);
        if($data == 1){
            $data = \App\Home\user::where('user_account','=',$account)->where('user_Grade','<','6')->get();
        }else{
            $data = [];
        }
        echo $data;
    }

    //修改用户登陆密码
    public function updatePW(Request $request){
        $account = $request->get('account');
        $newpw = $request->get('newpw');
        $msg = '';
        $data = \App\Home\user::where('user_account','=',$account)->where('user_Grade','<','6')->update([
            'user_password' => "$newpw"
        ]);
        echo $data;
    }

    //修改用户支付密码
    public function updatePay(Request $request){
        $account = $request->get('account');
        $newpw = $request->get('newpw');
        $msg = '';
        $data = \App\Home\user::where('user_account','=',$account)->where('user_Grade','<','6')->update([
            'user_pay' => "$newpw"
        ]);
        echo $data;
    }

    //根据用户账号获取用户ID查询用户收货地址
    public function receiveAddress(Request $request){
        $account = $request->get('account');
        $data = \App\Home\user::where('user_account','=',$account)->where('user_Grade','<','6')->select('user_id')->get();
        $id = $data[0]->user_id;
        $data = \App\Home\address::where('user_id','=',$id)->where('address_status','=','1')->get();
        echo $data;
    }

    //添加用户收货地址
    public function addAddress(Request $request){
        $name = $request->get('name');
        $phone = $request->get('phone');
        $province = $request->get('province');
        $city = $request->get('city');
        $area = $request->get('area');
        $detailed = $request->get('detailed');
        $zip = $request->get('zip');
        $account = $request->get('account');
        $data = \App\Home\user::where('user_account','=',$account)->where('user_Grade','<','6')->select('user_id')->get();
        $id = $data[0]->user_id;
        $data = DB::insert("insert into address(user_name,user_phone,address_zip,address_province,address_city,address_district,address_detailed,user_id) 
        values(?,?,?,?,?,?,?,?)",[$name,$phone,$zip,$province,$city,$area,$detailed,$id]);
        echo $data;
    }

    //修改用户收货地址信息
    public function updateAddress(Request $request){
        $name = $request->get('name');
        $phone = $request->get('phone');
        $province = $request->get('province');
        $city = $request->get('city');
        $area = $request->get('area');
        $detailed = $request->get('detailed');
        $zip = $request->get('zip');
        $id = $request->get('id');
        $data = \App\Home\address::where('address_id','=',$id)->where('address_status','=','1')->update([
            'user_name' => "$name",
            'user_phone' => "$phone",
            'address_zip' => "$zip",
            'address_province' => "$province",
            'address_city' => "$city",
            'address_district' => "$area",
            'address_detailed' => "$detailed",
        ]);
        echo $data;
    }

    //删除用户收货地址
    public function deteleAddress(Request $request){
        $id = $request->get('id');
        $account = $request->get('account');
        $data = \App\Home\user::where('user_account','=',$account)->where('user_Grade','<','6')->select('user_address_id')->get();
        $addressId = $data[0]->user_address_id;
        if($id == $addressId){
            $data = \App\Home\user::where('user_account','=',$account)->where('user_Grade','<','6')->update([
                'user_address_id' => "0"
            ]);
            if($data == 1){
                $data = \App\Home\address::where('address_id','=',$id)->where('address_status','=','1')->update([
                    'address_status' => "0"
                ]);
            }
        }else{
            $data = \App\Home\address::where('address_id','=',$id)->where('address_status','=','1')->update([
                'address_status' => "0"
            ]);
        }
        echo $data;
    }

    //设置用户默认地址
    public function defaultAddress(Request $request){
        $account = $request->get('account');
        $id = $request->get('id');
        $data = \App\Home\user::where('user_account','=',$account)->where('user_Grade','<','6')->update([
            'user_address_id' => "$id"
        ]);
        echo $data;
    }

    //获取用户购物车信息
    public function shopcarInfo(Request $request){
        $account = $request->get('account');
        $data = \App\Home\user::where('user_account','=',$account)->where('user_Grade','<','6')->select('user_id')->get();
        $id = $data[0]->user_id;
        $data = \App\Home\shopcarInfo::where('user_id','=',$id)->get();
        echo $data;
    }

    //修改购物车商品选择状态
    public function shopcarSel(Request $request){
        $id = $request->get('id');
        $status = $request->get('status');
        $data = \App\Home\shopcar::where('shopcar_id','=',$id)->update([
            'shopcar_status' => "$status"
        ]);
        echo $data;
    }

    //修改购物车商品的数量
    public function shopcarNum(Request $request){
        $id = $request->get('id');
        $num = $request->get('num');
        $data = \App\Home\shopcar::where('shopcar_id','=',$id)->update([
            'goods_num' => "$num"
        ]);
        echo $data;
    }

    //删除购物车商品
    public function shopcarDel(Request $request){
        $id = $request->get('id');
        $data = \App\Home\shopcar::where('shopcar_id','=',$id)->delete();
        echo $data;
    }

    //添加购物车商品
    public function shopcarAdd(Request $request){
        $no = $request->get('no');
        $account = $request->get('account');
        $data = \App\Home\user::where('user_account','=',$account)->where('user_Grade','<','6')->select('user_id')->get();
        $userId = $data[0]->user_id;
        $data = \App\Home\goods::where('goods_no','=',$no)->select('goods_id')->get();
        $goodsId = $data[0]->goods_id;
        $data = DB::insert("insert into shopcar(goods_id,user_id) values(?,?)",[$goodsId,$userId]);
        echo $data;
    }

    //提交商品到订单
    public function submitOrders(Request $request){
        $id = $request->get('id');
        $data = \App\Home\shopcar::where('shopcar_id','=',$id)->update([
            'shopcar_status' => "2"
        ]);
        echo $data;
    }
}

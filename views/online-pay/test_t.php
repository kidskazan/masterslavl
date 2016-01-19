<?
    use xj\qrcode\QRcode;
    use xj\qrcode\widgets\Text;
    use xj\qrcode\widgets\Email;
    use xj\qrcode\widgets\Card;
?>

<div style="background: url(img/body.jpg); background-color:#FF0004; background-size: 100% auto; width:100%; height:50.4cm; text-transform:uppercase">
            <div style="height:20px; width:250px;  margin-left:580px; padding-top:185px; position:absolute;">
                
            </div>
            
            <div style="height:20px; width:300px; float:left; z-index:1;  margin-left:160px; padding-top:70px; position:absolute;">
                <p  name="name" style="font-family:epson1; padding:0px; margin:0px; font-size:20px; text-transform:uppercase"><?=$name;?></p>
            
                <p name="sname" style="font-family:epson1;  font-size:20px;  padding:0px; margin:0px; text-transform:uppercase"><?=$surname;?></p>
            </div>
            
            <div style="height:20px; width:300px;  float:left; z-index:1;  padding-top:65px;  margin-left:120px;position:absolute;">
                <p  name="old" style="font-family:epson1; width:300px;  padding:0px; padding-bottom:10px; margin:0px; font-size:20px;"><?if ($type_ticket != 2):?><?php if ($old == 1) { echo $old.' ГОД';} else if ($old == 2) { echo $old.' ГОДА';} else if ($old == 3) { echo $old.' ГОДА';} else if ($old == 4) { echo $old.' ГОДА';} if ($old >= 5 && $old < 15) { echo $old.' ЛЕТ';} else if($old >=15) {echo 'СТАРШЕ 15 ЛЕТ';} ;?><?else:?><?=$old;?><?endif;?></p>
            
                <p name="status" style="font-family:epson1; width:300px; <?if ($type_ticket == 7):?>font-size:20px;<?else:?>font-size:20px;<?endif;?>  padding:0px; margin:0px;"><?=$name_tiket;?></p>
            </div>
            
            <div style="height:40px; width:100px; float:left; z-index:5;  margin-top:75px;padding-top:20px; padding-left:40px; position:absolute;">
                <p  name="marka" style="font-family:epson1; text-align:center;padding-top:15px; margin:0px; <?if ($type_ticket == 7):?>font-size:35px;<?else:?>font-size:40px;<?endif;?> "><?=$money;?></p>
            </div>
            
            <div style="height:20px; width:400px; float:left; z-index:1;  padding-top:10px; margin-left:45px;position:absolute;">
                <p  name="time" style="font-family:epson1; text-align:center; padding:0px; padding-bottom:10px; margin:0px; font-size:20px;"><?=$time;?></p>
            </div>
            
            <div style="height:20px; width:400px; float:left; z-index:1;   padding-top:10px;  margin-left:20px;position:absolute;">
                <p  name="data" style="font-family:epson1; text-align:center; padding:0px; padding-bottom:10px; margin:0px; font-size:20px;"><?=$date;?></p>
            </div>
            
            <div style=" width:139px; height:140px; padding:8px;  float:left; z-index:3; margin-left:-833px; margin-top:34px;  position:absolute;">
                <?
                    echo Text::widget([
                        'outputDir' => '@webroot/tikets/qrcode',
                        'outputDirWeb' => '@web/tikets/qrcode',
                        'ecLevel' => QRcode::QR_ECLEVEL_L,
                        'text' => $qr,
                        'size' => 4,
                        ]);
                ?>
                
            </div>
            
            <div style="height:20px; width:250px;   z-index:9;  margin-top:-146px;  margin-left:420px;position:absolute;">
                <p  name="to" style="font-family:epson1; width:250px;  padding:0px; margin:0px; font-size:20px;">МОСКВА-СИТИ</p>
            
                <p name="do" style="margin-top:12px;font-family:epson1; width:250px;    font-size:20px;  padding-top:4px">ст. МАСТЕРСЛАВЛЬ</p>
            </div>
            
            <div style="height:20px; width:140px;   z-index:1; float:left; margin-top:-24px;   margin-left:880px;position:absolute;">
                <p  name="date1" style="font-family:epson1; width:280px;  padding:0px; padding-bottom:18px; margin:0px; font-size:20px;"><?=$date1;?></p>
            
                <p name="date2" style="font-family:epson1; width:280px; font-size:20px;  padding:0px; margin:0px;"><?=$date2;?></p>
            </div>
            
            <div style="height:20px; width:100px; float:left; z-index:1;  margin-top:-132px;  margin-left:765px;position:absolute;">
                <p  name="money" style="font-family:epson1; text-align:center; padding-top:4px; margin:0px; font-size:20px;"><?=$price;?> р.</p>
            </div>
            
            
            
            <div style="height:20px; width:250px;  z-index:1;  margin-top:-35px;  margin-left:200px;position:absolute;">
                <p  name="number" style="font-family:epson1;  padding:0px; padding-bottom:10px;margin:0px; font-size:20px;"></p>
            </div>
            
            <div style="<?if ($pitanie):?>font-family:epson1; padding-bottom:10px; height:26px; background-image: url(img/pitanie.png);background-position:right;background-repeat:no-repeat<?endif;?> height:26px; width:300px; float:left; z-index:1;  margin-top:-37px;  margin-left:380px;position:absolute;">
                <p  name="about" style="font-family:epson1; padding:0px; padding-bottom:10px; margin:0px; font-size:20px;"><?if ($pitanie):?>Питание<?endif;?></p>
            </div>
            
            
            
             
            
    </div>
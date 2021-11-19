@extends('layout.admin.master')
@section('content_admin')
<?php
    $a = [
        1,3,3
    ];
    $tam = 0;
    $total = count($a);

    for($i = 0; $i < $total; $i ++) {
        $hientai = $a[$i];
        if($i + 1 >= $total) {
            break;
        }
        $ketiep = $a[$i+1];
        
        if($hientai > $ketiep) {
            $tam = $hientai;
        } else {
            continue;
        }
       
    }
    var_dump($tam);exit;

    // $i = 0; $i < 3
    // $hientai = 6;
    // $ketiep = 3;
    // $tam = 6;

    // $i = 1; $i < 3
    // $hientai = 3;
    // $ketiep = 3;
    // $tam = 3

    // $i = 2; $i < 3
    // $hientai = 5
    // $ketiep = khong xac dinh


//  $tam = '';
//  for($i = 0 ; $i < count($a); $i++){
//     if($a[0] > $a[1]){
//         $tam = $a[0];
        
//     }else{
//       $tam = $a[1];//2
//     }    
//     if($tam < $a[2]){     
       
//         echo 'có số lớn nhất';
//     }else{
//       $tam = $a[2];
//       echo 'sai đề';
//     }
//  }  
// .................1....................
/*
  $a = [
    3,5,1 // -> 5 3 1
  ];
  $tam = $a[0]; // 3
  $a[0] = $a[1]; // 5
  $a[1] = $tam; // 3
*/


$peoples = array(
    array(
        'name' => 'Kalle',
        'salt' => 856412
    ),
    array(
        'name' => 'Pierre',
        'salt' => 215863
    )
);
foreach($peoples as $items) {
    foreach($items as $key => $item)
}

// for($i = 0; $i < count($people); ++$i) {
//   for($z = 0; $z < count($people[$i]); ++$z){
//     var_dump($people[1]['sal']);
//   }
// } 


?>
    <!-- <form action="{{route('post_ajax_test')}}" id="formTest" method="POST" >
        @csrf
            
        <input type="text" id="text" name="text" /><br/>
        <input type="button" id="butSend" value="Send">

        <h3>Result</h3>
        <div id="result" style="border: 1px solid red; overflow: hidden; height: 300px;"></div>
    </form>

@stop

@section('footer_script')
<script>
  $(function () {

    $('#butSend').click(function (e) {
      
        e.preventDefault();

        var url = $('#formTest').attr('action');

        $.ajax({
            url: url,
            type: 'POST',
            data: {khuong: $('#khuong').val()},
            dataType: 'JSON',
            // submit post data and file
            contentType: false,
            cache : false,  // case when have upload file
            processData: false, // case when have upload file
            success: function (xxx) {
                
            }
        });
        var res = $('#text').val();
        $('#result').append(res);
    });

  });

</script> -->



@stop
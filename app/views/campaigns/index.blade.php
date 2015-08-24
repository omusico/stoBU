<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Campaigns</title>
@include("header2")
<?php
  $user = Auth::user();
  
  ?> 
 
  @include("guestNav2")
<?php 
//$media      = Media::where('status','=',1)->where('company','=',$user->companyID)->get();
//$recycleCnt = Media::where('status','=',2)->where('company','=',$user->companyID)->count();
?>
<style>
.dataTables_length, .dataTables_filter {
  margin: 0 15px;
}
#campaignTable th, #campaignTable tbody td{
  border:1px solid #dddddd;
  border-left:none;
}
#campaignTable{
  padding-top:15px;
  font-size:14px;
}
.dataTables_wrapper .dataTables_filter input{
  float:right;
}
#campaignTable th:first-child{
border-left:1px solid #dddddd;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active,
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover{
  color:#1188a3 !important;
  background:#fff;
  border: 1px solid #cacaca;
}
.icon-editicon-01{
    width: 22px;
  height: 22px;
}
.editTD{
  text-align:center;
}
.icon-plus{
  fill:#1188a3;
  width: 23px;
  height: 23px;
  margin-top: 11px;
  margin-left:15px;
}
.dataTables_wrapper{
  margin-top:10px;
}
h1{
  float:left;
  color:#1c2025 !important;
}
.circle {
  width: 10px;
  height: 10px;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius: 5px;
  float:right;
  margin-top: 5px;

}
.green{
  background:#3DC23D;
  /*box-shadow:0px 1px 7px 1px #005926;
    box-shadow: 0px 1px 0px 1px #005926;
  */
}
.red{
  background:red;
  /*box-shadow:0px 1px 7px 1px #8A010B;
    box-shadow: 0px 1px 0px 1px #8A010B;
  */
}
.panel-heading{
  background:#dedede !important;
  text-align:left;
}
.campaignWrapper{
  background:#fbfbfb;
  margin-top:30px;
}
</style>
<script>
$(document).ready(function(){
  $('#campaignTable').DataTable( {
    paging: true,
    "order": [[0, "asc" ]]
  });
});
</script>
<div class="innerContent" id="mainInnerContent">
<div class="container">
  <div class="row">
    <div class="col-md-12">
     <h1 style="float:left;">Campaigns</h1><a href="/campaigns/new"><svg class="icon icon-plus"><use xlink:href="#icon-plus"></use></svg><span class="mls"></span></a>
     
     <div class="campaignWrapper">
     <header class="panel-heading">All Campaigns</header>
     <table id="campaignTable" class="table striped">
      <thead>
        <tr><th>Campaign Title</th><th>Start</th><th>End</th><th>Status</th><th class="editTD">Edit</th></tr>
      </thead>
      <tbody>
        <?php
          foreach($campaigns as $campaign){
            echo "<tr><td>".$campaign->title."</td><td>".$campaign->startDate."</td><td>".$campaign->endDate."</td><td>";
            $todayd = date("d");
            $todaym = date("n");
            $todayy = date("Y");
            $todayStamp = mktime(23,59,0,$todaym,$todayd,$todayy);

            $data   = preg_split('/\s+/', $campaign->endDate);
            $dataStamp = mktime(23,59,0,$data[1], $data[2], $data[0]);

            $dataStart   = preg_split('/\s+/', $campaign->startDate);
            $dataStartStamp = mktime(23,59,0,$dataStart[1], $dataStart[2], $dataStart[0]);

            if($dataStamp >= $todayStamp && $dataStartStamp <= $todayStamp){
              echo "Active <div class='circle green'></div>";
            }else{
              echo "Inactive <div class='circle red'></div>";
            }
            
            echo '</td><td class="editTD"><a href="/campaigns/edit/'.$campaign->_id.'"><svg class="icon icon-editicon-01"><use xlink:href="#icon-editicon-01"></use></svg><span class="mls"></span></a></td></tr>';
          }
        ?>
      </tbody>
    </table>
  </div>
</div>
  <!-- // Form Wizard / Arrow navigation & Progress bar END -->
</div>
</div>
</div>



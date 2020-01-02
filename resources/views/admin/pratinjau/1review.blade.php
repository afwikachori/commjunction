<div class="container">

 <div class="row">

 	 <div class="col-sm" style="margin-top: 2em;">
 	 <div class="form-group mb-4">
      <label lang="en" >
      	Community Name
      </label>
      <input class="form-control" type="text" placeholder="{{ $dt['community']['name'] }}" disabled>
  	</div>

     <div class="form-group mb-4">
    <label lang="en">Community Description</label>
    <textarea class="form-control" rows="3" disabled>{{ $dt['community']['description'] }}</textarea>
  	</div>
 
    <div class="form-group mb-4">
    <label>Community Type</label>
   <select id="type_com2" class="form-control" name="type_com2" disabled style="display: none;">
  </select>
   <input class="form-control" type="text" id="etcjenis" placeholder="{{ $dt['community']['cust_jenis_comm'] }}" disabled style="display: none;">
  </div>


    </div>


    <div class="col-sm" style="margin-top: 2em;">

    <div class="form-group mb-4">
    <label>Range Member</label>
   <select id="range_member2" class="form-control" name="range_member2" disabled>
    <option disabled selected> --- </option>
    <option value="10 - 50" >10 - 50</option>
    <option value="50 - 100" >50 - 100</option>
    <option value="100 - 1000" > 100 - 1000</option>
    <option value="> 1000"> > 1000 </option>
  </select>
  </div>

   <div class="form-group mb-4">
      <label lang="en" >
        Community Icon
      </label>
      <br>
     <img class="zoom" id="myImg" src="http://21.0.0.108:2312{{ $dt['community']['logo'] }}" style="width: 33%; height: auto;">

    </div>

    </div>
 	
 </div>

  
</div>

<!-- The Modal -->
<div id="myModal" class="modalq">
  <span class="closeq">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>

<?php 
include "db.php";
include "retrive.php";
include "update.php";
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Company Z Banking System</title>
  <link rel="stylesheet" href="./style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div id="app">

<header>
  <div class="header">
    <h1>My Account</h1>
      <button data-toggle="modal" style="<?php if (mysqli_num_rows($result_invest) > 0) {echo 'display: none';}else{echo '';}?>" data-target="#investingaccmodal">Open Investment Account</button>
      <button data-toggle="modal" style="<?php if (mysqli_num_rows($result_invest) > 0) {echo '';}else{echo 'display: none';}?>" data-target="#investingaccmodalclose">Close Investment Account</button>
  </div>
</header>

<div class="modal" id="investingaccmodal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <div class="modal-header">
          <h4 class="modal-title">Investment Account</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <div class="modal-body">
          Are you sure to open an investment account ?
        </div>

        <div class="modal-footer">
          <form method="post" action="create.php">
            <button type="submit" name="create" class="btn btn-success">Yes</button>
          </form>  		
          <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
        </div>
        
      </div>
    </div>
  </div>
  <div class="modal" id="investingaccmodalclose">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <div class="modal-header">
          <h4 class="modal-title">Investment Account</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <div class="modal-body">
          Are you sure to close your investment account?<span style="<?php if ($row_invest_balance['acc_value']>0) {echo 'visibility: visible';}else{echo 'visibility: hidden';}?>"> If you wish to continue your balance <span style="color:#e07b00">RM<?php echo number_format((float)$row_invest_balance['acc_value'], 2, '.', '')?></span> will be transfer to your savings account</span>
        </div>
        
        <div class="modal-footer">
          <form method="post" action="delete.php">
            <button type="submit" name="delete" class="btn btn-success">Yes</button>
          </form>  		
          <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
        </div>
        
      </div>
    </div>
  </div>
  <div class="modal fade" id="investmentaddfunds" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Funds to Investment Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="addfund.php">
          <div class="row">
            <div class="col">
              <div class="input-box">
                <label for="transferAmount" class="form-label">Add Funds History</label>
                <ul class="list-group">
                <?php
                  if (mysqli_num_rows($result_invest_history) > 0) {
                    while($row_invest_history = mysqli_fetch_assoc($result_invest_history)) {
                  ?> 
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    RM <?php echo number_format((float)$row_invest_history['amount'], 2, '.', '')?>
                    <span class="badge badge-primary badge-pill"><?php echo date('d-m-Y',strtotime($row_invest_history['datetime']))?></i></span>
                  </li>
                  <?php
                  }
                }else{
                  echo "<span style='color:red;text-align:left;'>No history found</span>";
                }
                ?>
                </ul>
              </div>   
            </div>
            <div class="col">
              <div class="input-box">
                <label for="transferAmount" class="form-label">Amount: RM<span id="amountname2"> 0.00</span></label>
                <input type="number" class="form-control"  step=".01" name="amount2" required/><br>
                <button type="submit" name="addfunds" class="btn btn-primary">Add</button>
              </div>
            </div>
          </div>
          
        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>

<section>
  <form method="post" action="update.php" style="margin-left:40px;margin-right:40px;">
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label class="form-label" for="Account-1">From:</label>
          <select class="form-control" name="acc_1" id="select1" required>
            <option value="" selected disabled>Select an account</option>
            <option value="Savings Account">Savings Account</option>
            <option value="Goals Account">Goals Account</option>
          </select>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label class="form-label" for="Account-2">To:</label>
          <select class="form-control" name="acc_2" id="select2" required>
            <option value="" selected disabled>Please select from first</option> 
          </select>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="transferAmount" class="form-label">Amount:<span style="color:#e07b00"> RM <span id="amountname"> 0.00</span><span></label>
      <input type="number" id="amountjs" class="form-control"  step=".01" min="0.01" max="" name="amount" required/>
    </div>
    <div class="form-group">
    
      <button class="btn btn-primary" name="update">Transfer</button>
    </div>
  </form>
</section>

<section :class="revealClass">
  <div class="accounts">
    <ul>
      <?php
        if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
        ?> 
        <li>
          <p>
            <strong><?php echo $row['acc_name']?> <a href="" title="Add funds to investment account" data-toggle="modal" data-target="#investmentaddfunds" style="<?php if($row['acc_name']=="Investment Account"){echo 'visibility: visible';}else{echo 'visibility: hidden';}?>"><i class="fa fa-plus"></i></a></strong>
          </p>
          <p :class="balance1">RM <?php echo number_format((float)$row['acc_value'], 2, '.', '')?></p>
        </li>
        <?php
      }
    }
    ?>
    </ul>
  </div>
</section> 
  
</div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</body>
</html>
<script>
  $('input[name=amount]').keyup(function(){
  $('#amountname').text( this.value );
});
</script>
<script>
  $('input[name=amount2]').keyup(function(){
  $('#amountname2').text( this.value );
});
</script>
<script>
  $(document).ready(function () {
    $("#select1").change(function () {
        var val = $(this).val();
        $.ajax({
            type: "GET",
            url: "validate.php?val=" + val,
            data: $('#select1').serialize()
            }).done(function(data) {
              document.getElementById('amountjs').max = data;
        });
        if (val == "Savings Account") {
            $("#select2").html("<option value='Goals Account'>Goals Account</option>");
        } else if (val == "Goals Account") {
            $("#select2").html("<option value='Savings Account'>Savings Account</option>");
        }
    });
});
</script>




<?php
include("db_connect.php");
?>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
*
{
	margin: 0;
	padding: 0;
	box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}
body 
{
	display: flex;
	justify-content: center;
	align-items: center;
	min-height: 100vh;
	flex-direction: column;
}.form-control:disabled, .form-control[readonly] {
    background: #e9ecef;
    width: 350px;
    opacity: 1;
}
.box 
{
	position: relative;
	width: 436px;
	height: 551px;
	background: #1c1c1c;
	border-radius: 8px;
	overflow: hidden;
}
.box::before 
{
	content: '';
	z-index: 1;
	position: absolute;
	top: -50%;
	left: -50%;
	width: 380px;
	height: 420px;
	transform-origin: bottom right;
	background: linear-gradient(0deg,transparent,gold,gold);
	animation: animate 6s linear infinite;
}
.box::after 
{
	content: '';
	z-index: 1;
	position: absolute;
	top: -50%;
	left: -50%;
	width: 380px;
	height: 575px;
	transform-origin: bottom right;
	background: linear-gradient(0deg,transparent,gold,gold);
	animation: animate 6s linear infinite;
	animation-delay: -3s;
}
@keyframes animate 
{
	0%
	{
		transform: rotate(0deg);
	}
	100%
	{
		transform: rotate(360deg);
	}
}
form 
{
	position: absolute;
	inset: 2px;
	background: black;
	padding: 50px 40px;
	border-radius: 8px;
	z-index: 2;
	display: flex;
	flex-direction: column;
}

.inputBox 
{
	position: relative;
	width: 300px;
	margin-top: 25px;
}
.inputBox input 
{
	position: relative;
	width: 100%;
	/* padding: 20px 10px 10px; */
	background: transparent;
	outline: none;
	box-shadow: none;
	border: none;
	color: #23242a;
	transition: 0.5s;
	z-index: 10;
}
.inputBox span 
{
	position: absolute;
	left: 0;
	padding: 20px 0px 10px;
	pointer-events: none;
	font-size: 1em;
	color: #8f8f8f;
	letter-spacing: 0.05em;
	transition: 0.5s;
}
.inputBox input:valid ~ span,
.inputBox input:focus ~ span 
{
	color: #45f3ff;
	transform: translateX(0px) translateY(-34px);
	font-size: 0.75em;
}
.inputBox i 
{
	position: absolute;
	left: 0;
	bottom: 0;
	width: 100%;
	height: 2px;
	background: #45f3ff;
	border-radius: 4px;
	overflow: hidden;
	transition: 0.5s;
	pointer-events: none;
	z-index: 9;
}
.inputBox input:valid ~ i,
.inputBox input:focus ~ i 
{
	height: 44px;
}

.form-control{
    text-align:center;
    font-weight:bold;
}


    </style>



  <body>

  <?php
  $id = $_SESSION['id'];
  $query = "select * from users where id='$id'";
  $result = mysqli_query($conn,$query);
  $data = mysqli_fetch_assoc($result);
  ?>
<div class="container-fluid">
    

        <div class="data">
            <div class="col-md-4 mx-auto ">


<div class="card" style="background:black; width: 480px;">
	<div class="card-body">
    <div class="box">
<form>


<div class="text-center">
<img src="assets/images/userIcon.png" height="100" width="100">
</div>

 
    <!-- ID -->
    <div class="inputBox">
        <input type="text" value="ID: <?php echo $data['id']; ?>" class="form-control" disabled>	
    </div>


    <!-- Full Name -->
    <div class="inputBox">
        <input type="text" value="FULL NAME: <?php echo $data['name']; ?>" class="form-control" disabled>
    </div>


    <!-- Username -->
    <div class="inputBox">
        <input type="text" value="USERNAME: <?php echo $data['username']; ?>" class="form-control" disabled>  
    </div>


    <!-- Email -->
    <div class="inputBox">
        <input type="text" value="EMAIL: <?php echo $data['email']; ?>" class="form-control" disabled>
    </div>


    <!-- Status -->
    <div class="inputBox">
        <input type="text" value="STATUS: <?php if($data['status']==1) { echo "Active"; } else { echo "Inactive"; } ?>" class="form-control" disabled>
    </div>

    <!-- Role -->
    <div class="inputBox">
        <input type="text" value="ROLE: <?php if($data['type']==1) { echo "Admin"; }else if($data['type']==2) { echo "Staff"; } ?>" class="form-control" disabled> 
    </div>
</form>

</div>
</div>
</div>
</div>
</div>
</div>
</body>
</html>

<?php
	/*
		Plugin Name: Belajar CRUD
		Plugin URI: https://www.instagram.com/lin_sftri
		Description: Linda Safitri Belajar Plugin CRUD
		Version: 0.1
		Author: Linda
		Author URI: https://www.atmaluhur.ac.id
		License: GPL2
	*/
?>

<?php 
	function modulku() { ?>
			<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
			<link rel="stylesheet" href="https://www.fontawesomecheatsheet.com/assets/font-awesome/css/font-awesome.min.css">
			
		  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
		  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
		  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
		  <style>
		  .fakeimg {
		    height: 200px;
		    background: #aaa;
		  }
		  </style>

		  <link href="<?= plugin_dir_url( __FILE__ ) ?>lightbox2-2.11.4/dist/css/lightbox.css" rel="stylesheet" />

		  <div class="jumbotron text-center" style="margin-bottom:0">
			  <h1>Belajar CRUD</h1>
			  <p>Resize this responsive page to see the effect!</p> 
			</div>

			<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
			  <a class="navbar-brand" href="admin.php?page=linkku">Home</a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
			    <span class="navbar-toggler-icon"></span>
			  </button>
			  <div class="collapse navbar-collapse" id="collapsibleNavbar">
			    <ul class="navbar-nav">
			      <li class="nav-item">
			        <a class="nav-link" href="admin.php?page=linkku&hal=barang">Barang</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="admin.php?page=linkku&hal=pelanggan">Pelanggan</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="admin.php?page=linkku&hal=pesanan">Pesanan</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="admin.php?page=linkku&hal=lin_supplier026">Supplier</a>
			      </li>    
			    </ul>
			  </div>  
			</nav>

			<div class="container" style="margin-top:30px">
			  <div class="row">
			    <div class="col-sm-4">
			      <h2>About Me</h2>
			      <h5>Photo of me:</h5>
			      <div class="fakeimg">Fake Image</div>
			      <p>Some text about me in culpa qui officia deserunt mollit anim..</p>
			      <h3>Some Links</h3>
			      <p>Lorem ipsum dolor sit ame.</p>
			      <ul class="nav nav-pills flex-column">
			        <li class="nav-item">
			          <a class="nav-link active" href="#">Active</a>
			        </li>
			        <li class="nav-item">
			          <a class="nav-link" href="#">Link</a>
			        </li>
			        <li class="nav-item">
			          <a class="nav-link" href="#">Link</a>
			        </li>
			        <li class="nav-item">
			          <a class="nav-link disabled" href="#">Disabled</a>
			        </li>
			      </ul>
			      <hr class="d-sm-none">
			    </div>
			    <div class="col-sm-8">
			    	<?php
			    	//Create connection
			    	$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
					// Check connection
					if ($conn->connect_error) {
					  die("Connection failed: " . $conn->connect_error);
					}
			    		if(isset($_GET['hal'])):
			    			$hal = $_GET['hal'];
			    			include($hal . ".php");
			    		else:
			    			include("home.php");
			    		endif;
			    	?>
			      
			    </div>
			  </div>
			</div>

			<div class="jumbotron text-center" style="margin-bottom:0">
			  <p>Footer</p>
			</div>

			<script src="<?= plugin_dir_url( __FILE__ ) ?>lightbox2-2.11.4/dist/js/lightbox-plus-jquery.js"></script>

		<?php } ?>

<?php 
	function menuku() {
		add_menu_page(
			'Belajar CRUD', #title dokumen
			'menunya apa',  #text yang tampil dimenu admin
			'read', #capabilities untuk masing-masing peran punya privilage tertentu
			'linkku', #link yang tampil
			'modulku' #modul yang dipanggil 
		);
	}

	add_action('admin_menu', 'menuku');
?>

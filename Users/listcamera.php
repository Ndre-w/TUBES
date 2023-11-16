
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ridex - Rent your favourite car</title>

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="../favicon.svg" type="./image/svg+xml">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="listkamera.css">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&family=Open+Sans&display=swap"
    rel="stylesheet">
</head>

<body>
  
  <!-- 
    - #HEADER
  -->
  
  <header class="header" data-header>
    <div class="container">
      
      <div class="overlay" data-overlay></div>
      <button class="Btnn" onclick="goBack()">
        <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024"><path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"></path></svg>
        <span>Back</span>
      </button>

      <nav class="navbar" data-navbar>
        <ul class="navbar-list">

          <li>
            <h1>Camera List</h1>
          </li>


        </ul>
      </nav>

      <div class="header-actions">


        <button class="Btn" onclick="goToLogOut()">
  
        <div class="sign"><svg viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path></svg></div>
        
        <div class="text">Logout</div>
        </button>





        <button class="nav-toggle-btn" data-nav-toggle-btn aria-label="Toggle Menu">
          <span class="one"></span>
          <span class="two"></span>
          <span class="three"></span>
        </button>

      </div>

    </div>
  </header>


  <main>
    <article>

      <!-- 
        - #FEATURED CAR
      -->
    
      <section class="section featured-car" id="featured-car">
        <div class="container">

          <div class="title-wrapper">
            <h2 class="h2 section-title">Rent Camera</h2>
            <h3 class="h3 section-title">Sony Camera</h3>

          </div>

          <ul class="featured-car-list">

          <?php
            include 'koneksi.php';

            // Ambil data dari database
            $sql = "SELECT id, nama, harga, foto, stok FROM kamera";
            $result = $conn->query($sql);

            // Tampilkan data dalam bentuk tabel
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    // Display camera cards here
                    echo "<li>
                    <div class='featured-car-card'>
            
                      <figure class='card-banner'>
                          <img src='../pengontrol/image/" . $row["foto"] . "' alt='Sony Alpha A1' loading='lazy' width='440' height='300' class='w-100'>
                      </figure>
                      <div class='card-content'>
            
                        <div class='card-title-wrapper'>
                          <h3 class='h3 card-title'>
                              <a href='#'>" . $row["nama"] . "</a>
                          </h3>
            
                          <data class='year' value='2021'>2021</data>
                        </div>
            
                        <ul class='card-list'>
            
                          <li class='card-list-item'>
                            <ion-icon name='people-outline'></ion-icon>
            
                            <span class='card-item-text'>" . $row["stok"] . "</span>
                          </li>
            
                          <li class='card-list-item'>
                            <ion-icon name='flash-outline'></ion-icon>
            
                            <span class='card-item-text'>Hybrid</span>
                          </li>
            
                          <li class='card-list-item'>
                            <ion-icon name='speedometer-outline'></ion-icon>
            
                            <span class='card-item-text'>6.1km / 1-litre</span>
                          </li>
            
                          <li class='card-list-item'>
                            <ion-icon name='hardware-chip-outline'></ion-icon>
            
                            <span class='card-item-text'>Automatic</span>
                          </li>
            
                        </ul>
            
                        <div class='card-price-wrapper'>
            
                          <p class='card-price'>
                            <strong>Rp.". $row["harga"] ."</strong> / month
                          </p>
            
            
                          <button class='btn'>Rent now</button>
            
                        </div>
            
                      </div>
            
                    </div>
                  </li>";
                }
                echo "</table>";
            } else {
                echo "Tidak ada data kamera.";
            }

            $conn->close();
            ?>

          </ul>

        </div>
      </section>

    </article>
  </main>



  <!-- 
    - custom js link
  -->
  <script src="./assets/js/script.js"></script>
 
 <script>
     
     function goToLogOut() {
       window.location.href = '../loginreg/logout.php';
     }
     function goBack() {
      window.history.back();
    }
 </script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
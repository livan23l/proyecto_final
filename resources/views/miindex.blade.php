<x-template-nice-admin>
  <!-- Title -->
  <div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="pagetitle col-sm-12 col-md-4 col-lg-4 col-xl-4">
        <img src="{{ asset('NiceAdmin/assets/img/logo.png') }}" alt="Logo VERN" />
      </div>
      <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">
        <h2 class="">Votación Electrónica y Recomendación de noticias</h2>
      </div>
    </div>
    <hr />
  </div>
  <!-- End Title Section -->

  <!-- Card Section -->
  <section class="row" style="background-color: rgb(235, 231, 231);">
      <!-- Voting -->
      <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
        <div class="card">
          <img src="{{ asset('NiceAdmin/assets/img/electronic voting.jpg') }}" class="card-img-top" alt="voting image">
          <div class="card-body">
            <h5 class="card-title">Votación electrónica</h5>
            <p class="card-text">Vota de manera <b><i>electrónica, fácil y segura</i></b> por los candidatos a la presidencia de México</p>
          </div>
        </div>
      </div>

      <!-- Forum -->
      <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
        <div class="card">
          <img src="{{ asset('NiceAdmin/assets/img/forum.jpg') }}" class="card-img-top" alt="forum image">
          <div class="card-body">
            <h5 class="card-title">Foro de propuestas</h5>
            <p class="card-text"><b>Comparte</b> tus propias propuestas de ley en un foro al resto de ciudadanos y vota por las que más te gusten.</p>
          </div>
        </div>
      </div>

      <!-- News -->
      <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
        <div class="card">
          <img src="{{ asset('NiceAdmin/assets/img/news.jpg') }}" class="card-img-top" alt="news image">
          <div class="card-body">
            <h5 class="card-title">Recomendación de noticias</h5>
            <p class="card-text">Infórmate de las noticias del momento con nuestro <i>sistema de recomendación de noticias</i> basado en tus preferencias.</p>
          </div>
        </div>
      </div>

      <!-- Validation -->
      <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
        <div class="card">
          <img src="{{ asset('NiceAdmin/assets/img/validation.jpg') }}" class="card-img-top" alt="validation image">
          <div class="card-body">
            <h5 class="card-title">Valida tu cuenta utilizando tu INE</h5>
            <p class="card-text">Valida tu cuenta de forma <b>segura</b> y <b>fácil</b> por medio de tu identificación oficial INE o IFE.</p>
          </div>
        </div>
      </div>
  </section>
  <!-- End Card Section -->

  <!-- Graphic Section -->
  <section class="row justify-content-center align-items-center">
    <div class="col-sm-12 col-md-10 col-lg-8 col-lg-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Últimas votaciones electorales 2018</h5>

          <!-- Pie Chart -->
          <canvas id="pieChart" style="max-height: 400px;"></canvas>
          <script>
            document.addEventListener("DOMContentLoaded", () => {
              new Chart(document.querySelector('#pieChart'), {
                type: 'pie',
                data: {
                  labels: [
                    'MORENA',
                    'PAN',
                    'PRI',
                    'Independientes',
                    'Votos Nulos'
                  ],
                  datasets: [{
                    data: [53.19, 22.27, 16.40, 5.23, 2.91],
                    backgroundColor: [
                      'rgb(213, 36, 33)',
                      'rgb(52, 166, 254)',
                      'rgb(42, 162, 60)',
                      'rgb(175, 60, 198)',
                      'rgb(171, 171, 171)'
                    ],
                    hoverOffset: 6
                  }]
                }
              });
            });
          </script>
          <!-- End Pie CHart -->

        </div>
      </div>
    </div>
  </section>
  <!-- End Graphic Section -->


</x-template-nice-admin>
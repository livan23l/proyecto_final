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
  </div>
  <hr />
  <!-- End Title Section -->

  <!-- Card section -->
  <section class="section">
    <div class="row">
      <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
        <div class="card">
          <img src="{{ asset('NiceAdmin/assets/img/card.jpg') }}" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Card with an image on top</h5>
            <p class="card-text">Vota de manera <i>electrónica, fácil y segura</i> por los candidatos a la presidencia de México y por los candidatos a diputados</p>
          </div>
        </div>
      </div>

      <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
        <div class="card">
          <img src="{{ asset('NiceAdmin/assets/img/card.jpg') }}" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Recomendación de noticias</h5>
            <p class="card-text">Infórmate de las noticias del momento con nuestro <i>sistema de recomendación de noticias</i> basado en tus preferencias.</p>
          </div>
        </div>
      </div>

      <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
        <div class="card">
          <img src="{{ asset('NiceAdmin/assets/img/card.jpg') }}" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Card with an image on top</h5>
            <p class="card-text">Vota de manera <i>electrónica, fácil y segura</i> por los candidatos a la presidencia de México y por los candidatos a diputados</p>
          </div>
        </div>
      </div>

      <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
        <div class="card">
          <img src="{{ asset('NiceAdmin/assets/img/card.jpg') }}" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Recomendación de noticias</h5>
            <p class="card-text">Infórmate de las noticias del momento con nuestro <i>sistema de recomendación de noticias</i> basado en tus preferencias.</p>
          </div>
        </div>
      </div>

    </div>
  </section>
  <!-- End Card Section -->

  <section class="section">
    <div class="col-lg-5">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Pie Chart</h5>

          <!-- Pie Chart -->
          <div id="pieChart"></div>

          <script>
            document.addEventListener("DOMContentLoaded", () => {
              new ApexCharts(document.querySelector("#pieChart"), {
                series: [44, 55, 13, 43, 22],
                chart: {
                  height: 350,
                  type: 'pie',
                  toolbar: {
                    show: true
                  }
                },
                labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E']
              }).render();
            });
          </script>
          <!-- End Pie Chart -->

        </div>
      </div>
    </div>
  </section>



</x-template-nice-admin>
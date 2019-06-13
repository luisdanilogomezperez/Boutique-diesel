<section class="section section-lg bg-gradient-default">
  <div class="container pt-lg pb-300">
    <div class="row text-center justify-content-center">
      <div class="col-lg-10">
        <h2 class="display-3 text-white">Somos una comunidad dedicada al disfrute y respeto de la vida, nuestro hobby es comercializar la mejor ropa del mundo</h2>
      </div>
    </div>
    <div class="row row-grid mt-5">
      <div class="col-lg-4">
        <div class="icon icon-lg icon-shape bg-gradient-white shadow rounded-circle text-primary">
          <i class="fas fa-balance-scale"></i>
        </div>
        <h5 class="text-white mt-3">Filosofia</h5>
        <p class="text-white mt-3">Para tener una comunidad consciente y con personas de alto rendimiento, es necesario buscar el equilibrio en la vida a través de 5 pilares que fomentan y promueven el bienestar. La alimentación, el deporte, el ocio, la socialiazación y el conocimiento.
        </p>
      </div>
      <div class="col-lg-4">
        <div class="icon icon-lg icon-shape bg-gradient-white shadow rounded-circle text-primary">
          <i class="fas fa-handshake"></i>
        </div>
        <h5 class="text-white mt-3">Nosotros</h5>
        <p class="text-white mt-3">Somos una empresa del sector textil, dedicada a comercializar ropa desde el 2010. Con el tiempo nos dimos cuenta que tenemos la responsabilidad de ir más allá de vender ropa y realmente aportar a la transformación de la sociedad, poniendo a las personas como el centro de todo lo que hacemos.</p>
      </div>
      <div class="col-lg-4">
        <div class="icon icon-lg icon-shape bg-gradient-white shadow rounded-circle text-primary">
          <i class="fas fa-street-view"></i>
        </div>
        <h5 class="text-white mt-3">Redes Sociales</h5>
        <p class="text-white mt-3">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      </div>
    </div>
  </div>
  <!-- SVG separator -->
  <div class="separator separator-bottom separator-skew zindex-100">
    <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
      <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
    </svg>
  </div>
</section>

<section class="section section-lg pt-lg-0 section-contact-us">
  <div class="container">
    <div class="row justify-content-center mt--300">
      <div class="col-lg-8">
        <div id="comunicarse"></div>
        <div class="card bg-gradient-secondary shadow">
          <div class="card-body p-lg-5">
            <h4 class="mb-1">Quieres comunicarte con Boutique?</h4>
            <p class="mt-0">Diligencia este formulario si necesitas información relacionada con el proceso de compra online o una duda en general.</p>
            <p>Responderemos su mensaje a los datos enviados en el formulario en un plazo maximo de 3 dias.  </p>
            
            <form  method="POST" id="formContacto">
            <div class="form-group mt-2">
              <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input class="form-control" placeholder="Nombre" type="text" name="nombreMensaje" id="nombreMensaje" required>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                </div>
                <input class="form-control" placeholder="Correo Electronico" type="email" name="correoMensaje" id="correoMensaje" required>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-tag"></i></span>
                </div>
                <input class="form-control" placeholder="Asunto" type="text" name="asuntoMensaje" id="asuntoMensaje" required>
              </div>
            </div>
            <div class="form-group">
            <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-edit"></i></span>
                </div>
                <textarea class="form-control" rows="4" cols="80" placeholder="Escriba su mensaje..." name="textoMensaje" id="textoMensaje" required></textarea>
              </div>
            </div>
            <div>
              <button type="submit" class="btn btn-default btn-round btn-block btn-lg"><i class="fas fa-paper-plane mr-2"></i>Enviar Mensaje</button>
            </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<style>
  /* html { background-color: #36383f; font-size: 20px; } */



.contenedor-403 #hole1 { top: var(--hole-distance); left: var(--hole-distance);}
.contenedor-403 #hole2 { top: var(--hole-distance); right: var(--hole-distance);}
.contenedor-403 #hole3 { bottom: var(--hole-distance); left: var(--hole-distance);}
.contenedor-403 #hole4 { bottom: var(--hole-distance); right: var(--hole-distance);}

.contenedor-403 .hole {
  width: 20px;
  height: 20px;
  position: absolute;
  border-radius: 50%;
  background-image: radial-gradient(circle at 99%, #f4f4f4 10%, grey 70%);
  transform: rotate(45deg);
}

.contenedor-403 #sign-wrapper {
  background-color: #f4f4f4;
  position: relative;
  width: 80%;
  min-width: 340px;
  max-width: 800px;
  height: 90%;
  margin: 2% auto;
  padding: 50px;
  border: 1px solid #e9ecf0;
  border-radius: 45px;
  box-shadow: 5px 5px 10px #000;
  font-family: "Montserrat", sans-serif;
  font-size: 1rem;
}

.contenedor-403 #header {
  background-color: #ef5350;
  padding: 20px;
  border-radius: 30px 30px 0 0;
  text-align: center;
}

.contenedor-403 h1 {
  text-transform: uppercase;
  color: #f4f4f4;
  font-size: 5.5em;
  line-height: .9em;
  letter-spacing: 3px;
  margin: 0;
  font-weight: 900;
}

.contenedor-403 .strike {
  position: absolute;
  width: 25%;
  height: 10px;
  background-color: #fff;
}
.contenedor-403 #strike1 { top: 115px; left: 80px; }
.contenedor-403 #strike2 { top: 115px; right: 80px; }

.contenedor-403 #sign-body {
  display: flex;
  flex-wrap: nowrap;
}
.contenedor-403 #copy-container   { flex-basis: 60%; }
.contenedor-403 #circle-container { flex-basis: 40%; }

.contenedor-403 h2, .contenedor-403 p {
  text-align: center;
  color: #1d1e22;
}

.contenedor-403 h2 {
  font-size: 3em;
  text-transform: uppercase;
  margin: 40px 0;
  line-height: .9em;
}
.contenedor-403 p { 
  font-size: 20px; 
}

@media screen and (max-width: 930px) {
  .contenedor-403 #sign-wrapper { 
    font-size: .75rem; }
}
@media screen and (max-width: 750px) {
  .contenedor-403 #sign-wrapper { 
    font-size: .6rem; }
  .contenedor-403 h2 { 
    margin: 25px 0; }
  .contenedor-403 .strike { 
    visibility: hidden; }
}
@media screen and (max-width: 600px) {
  .contenedor-403 #sign-wrapper { 
    font-size: .4rem; 
    padding: 15px;
    border-radius: 25px;
  }
  .contenedor-403 #header {
    border-radius: 20px 20px 0 0;
  }
  .contenedor-403 #circle-container {
    width: 50%;
  }
  .contenedor-403 .hole {
    width: 10px;
    height: 10px;
  }
  .contenedor-403 :root {
    --hole-distance: 8px;
  }
}
@media screen and (max-width: 450px) {
  .contenedor-403 #sign-wrapper { 
    font-size: .34rem; }
  .contenedor-403 h2 { 
    margin: 10px; }
  .contenedor-403 p { 
    font-size: 14px; }
}
</style>


<section class="container contenedor-403 d-flex justify-content-center p-2 align-items-center" style="min-height: 95vh;">
<div id="sign-wrapper">
  <div id="hole1" class="hole"></div>
  <div id="hole2" class="hole"></div>
  <div id="hole3" class="hole"></div>
  <div id="hole4" class="hole"></div>
  <header id="header">
    <h1>403 forbidden</h1>
    <div id="strike1" class="strike"></div>
    <div id="strike2" class="strike"></div>
  </header>
  <section id="sign-body">
    <div id="copy-container">
      <h2>Authorized Personnel Only</h2>
      <p><strong>Error 403: Forbidden</strong>. You do not have permission to view this page.</p>
    </div>
    <div id="circle-container">
      <svg version="1.1" viewBox="0 0 500 500" preserveAspectRatio="xMinYMin meet">
        <defs>
          <pattern id="image" patternUnits="userSpaceOnUse" height="450" width="450">
            <image x="25" y="25" height="450" width="450" xlink:href="https://upload.wikimedia.org/wikipedia/commons/8/89/Portrait_Placeholder.png"></image>
          </pattern>
        </defs>
        <circle cx="250" cy="250" r="200" stroke-width="40px" stroke="#ef5350" fill="url(#image)"/>
        <line x1="100" y1="100" x2="400" y2="400" stroke-width="40px" stroke="#ef5350"/>
      </svg>
    </div>
  </section>
</div>
</section>
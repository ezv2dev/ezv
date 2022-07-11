<style>
.loading-splash-screen-detail{
  background-color: white;
  height: 100%;
  position: fixed;
  z-index: 9999;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.loading-splash-screen-detail img{
  width: auto;
}

body {
  margin: 0;
}

.wrapper {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  min-width: 100vw;
  background-color: white;
}

.load {
  position: relative;
  width: 200px;
  height: 50px;
  margin: 200px auto
}

.load span {
  position: absolute;
  width: 10px;
  height: 10px;
  background-color: #ff7400;
  border-radius: 50%;
  left: 50px;
  bottom: 0;
  animation: snake 0.8s infinite ease-in-out
}

.load span:nth-child(2) {
  left: 65px;
  animation-delay: 0.2s
}

.load span:nth-child(3) {
  left: 80px;
  animation-delay: 0.4s
}

.load span:nth-child(4) {
  left: 95px;
  animation-delay: 0.6s
}

.load span:nth-child(5) {
  left: 110px;
  animation-delay: 0.8s
}

.load span:nth-child(6) {
  left: 125px;
  animation-delay: 1s
}

.load span:nth-child(7) {
  left: 140px;
  animation-delay: 1.2s
}

.load span:nth-child(8) {
  left: 155px;
  animation-delay: 1.4s
}

.load span:nth-child(9) {
  left: 170px;
  animation-delay: 1.6s
}

@keyframes snake {
  0%,100% {
    transform: translateY(0px);
    box-shadow: 0px 0px 3px rgba(0,0,0,0.2);
  }
  50% {
    opacity: 1;
    transform: translateY(-10px);
    background: #ff7400;
    box-shadow: 0px 10px 0px rgba(0,0,0,0.02);
  }
}


</style>
<div id="loading-content" class="loading-splash-screen-detail">
<section class="wrapper">
  <div class="load">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
  </div>
</section>
</div>

<script>
    window.onload = () => {
        $('#loading-content').hide();
    }
</script>

<style>
.loading-splash-screen-detail{
  background-color: black;
  height: 100%;
  position: fixed;
  z-index: 9999;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.logo-container {
	
  background-image: linear-gradient(to right, #FEA429 , #FD6920);
	background-size: 400% 400%;
	animation: gradient 0.8s ease infinite;
  height: 80px;
  width: 170px;
  border-radius: 35px;
  display: flex;
  justify-content: center;
  color: white;
  font-size: 60px;
  align-items: center;
  text-shadow: 2px 2px #CE6A1C;
  font-family: serif !important;
}

@keyframes gradient {
	0% {
		background-position: 0% 50%;
	}
	50% {
		background-position: 100% 50%;
	}
	100% {
		background-position: 0% 50%;
	}
}





</style>
<div id="loading-content" class="loading-splash-screen-detail">
  <div class="logo-container">
    EZV
  </div>
</div>

<script>
    window.onload = () => {
        $('#loading-content').hide();
    }
</script>

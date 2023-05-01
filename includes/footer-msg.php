<style>
.bottom-nav {
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  z-index: 1;
  display: flex;
  justify-content: space-around;
  align-items: center;
  background-color: #fff;
  box-shadow: 0px -3px 6px rgba(0, 0, 0, 0.1);
}

.bottom-nav .nav-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  flex-grow: 1;
  height: 65px;
}

.bottom-nav .nav-item a {
  text-decoration: none; 
  color: #999;
}

.bottom-nav .nav-item.animate a i{
  font-size: 40px;
}

.bottom-nav .nav-item a i{
    font-size: 23px;
    color: rgba(0, 0, 0, 1);
    font-weight: 900;







}

</style>



<div class="bottom-nav">
  <div class="nav-item">
    <a href="messages.php">
      <i class="bi bi-chat"></i> 
    </a>
  </div>

  <div class="nav-item">
    <a href="first-msg.php">
      <i class="bi bi-chat"></i> 
    </a>
  </div>

  <div class="nav-item">
    <a href="message-friends.php">
      <i class="bi bi-people"></i>
    </a>
  </div>
</div>


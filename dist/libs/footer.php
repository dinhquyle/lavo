<footer class="footer">
  <div class="inner-box clearfix">
    <div class="left-box">
      <h2 class="ttl">Lavo CORP</h2>
      <div class="txt">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Risus commodo viverra maecenas accumsan lacus vel facilisis. 
      </div>
      <div class="social">
        <a href="javascript: void(0);">
          <img src="<?php echo APP_ASSETS ?>img/common/footer/icon_fb.png" alt="facebook">
        </a>
        <a href="javascript: void(0);">
          <img src="<?php echo APP_ASSETS ?>img/common/footer/icon_ytb.png" alt="youtube">
        </a>
      </div>
      <p class="txt1">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
    </div>
    <div class="right-box clearfix">
      <div class="box1">
        <h3 class="ttl">Link</h3>
        <ul class="list">
          <li>
            <a href="javascript: void(0);">Trang Chủ</a>
          </li>
          <li>
            <a href="javascript: void(0);">Giới Thiệu</a>
          </li>
          <li>
            <a href="javascript: void(0);">Thương Hiệu</a>
          </li>
          <li>
            <a href="javascript: void(0);">Kỹ Thuật</a>
          </li>
          <li>
            <a href="javascript: void(0);">Tin Tức</a>
          </li>
          <li>
            <a href="javascript: void(0);">Tuyển Dụng</a>
          </li>
          <li>
            <a href="javascript: void(0);">Liên Hệ</a>
          </li>
        </ul>
      </div>
      <div class="box2">
        <form action="#" class="frm-contact" method="post">
          <p class="txt-input">
            <input type="text" value="" name="txt-subject" class="txt-subject" placeholder="Địa chỉ email:" />
          </p>
          <p class="txt-input">
            <textarea name="txt-content" id="content" class="content" cols="30" rows="10" placeholder="input content"></textarea>
          </p>
          <p class="btn-box">
            <button type="submit" class="btnsend" class="btnsend">Gửi ngay</button>
          </p>
        </form>
      </div>
    </div>
  </div>
  <p class="txt-copy">&copy;2017 Lavo Corp</p>
</footer>

<script src="<?php echo APP_ASSETS; ?>js/lib/jquery1-12-4.min.js"></script>
<script src="<?php echo APP_ASSETS; ?>js/lib/smoothscroll.min.js"></script>
<script src="<?php echo APP_ASSETS; ?>js/lib/biggerlink.min.js"></script>
<script src="<?php echo APP_ASSETS; ?>js/common.min.js"></script>
<script src="<?php echo APP_ASSETS; ?>js/functions.min.js"></script>
<script>
  $(window).on('scroll load', function(){
    if($(window).scrollTop() > 99) $("body").addClass('header-fixed');
    else $("body").removeClass('header-fixed');
  });
</script>






















<script>
document.addEventListener('DOMContentLoaded', function() {
  const banner = document.querySelector('.support-ukraine');
  if (banner) {
    document.addEventListener('scroll', function() {
      if (window.scrollY > 100) {
        banner.classList.add('support-ukraine--hidden');
      } else {
        banner.classList.remove('support-ukraine--hidden');
      }
    });
  }
});
</script>
<style>
  .support-ukraine,
  .support-ukraine:visited {
    position: fixed;
    bottom: 10px;
    background: rgb(0, 0, 0);
    display: flex;
    justify-content: center;
    padding-top: 5px;
    padding-bottom: 5px;
    z-index: 10000;
    text-decoration: none;
    font-family: arial;
    padding: 10px;
    border-radius: 4px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    transition: all 0.2s ease-out;
  }
  .support-ukraine:hover,
  .support-ukraine:active {
    background: black;
    display: flex;
    background: rgb(80, 80, 80);
    text-decoration: none;
  }
  .support-ukraine--hidden {
    opacity: 0;
    pointer-events: none;
  }

  .support-ukraine--left {
    left: 10px;
  }
  .support-ukraine--center {
    left: 50%;
    transform: translatex(-50%);
  }
  .support-ukraine--right {
    right: 10px;
  }
  .support-ukraine__flag {
    height: 25px;
    margin-right: 10px;
  }
  .support-ukraine__flag__blue {
    width: 40px;
    height: 12.5px;
    background: #005bbb;
  }
  .support-ukraine__flag__yellow {
    width: 40px;
    height: 12.5px;
    background: #ffd500;
  }
  .support-ukraine__label {
    color: white;
    font-size: 14px;
    line-height: 25px;
  }
</style>
<a
  class="support-ukraine support-ukraine--<?= $placement ?>"
  href="<?= $url ?>"
  target="_blank"
  rel="nofollow noopener"
  title="<?= $label ?>"
>
  <div class="support-ukraine__flag" role="img" aria-label="Flag of Ukraine">
    <div class="support-ukraine__flag__blue"></div>
    <div class="support-ukraine__flag__yellow"></div>
  </div>
  <div class="support-ukraine__label"><?= $label ?></div>
</a>

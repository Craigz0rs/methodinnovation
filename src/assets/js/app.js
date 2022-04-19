function Epiqk() {

  this.consts = {
    namespace: 'epiqk',
    breakpoints: {
      no: 0, 
      xs: 480,
      sm: 600,
      md: 782,
      lg: 960,
      xl: 1080,
      xxl: 1280,
      xxxl: 1440
    },
    breakpoint: 'md',
    breakpointNav: 'xl',
    transition: {
      fast: 275,
      medium: 400,
      slow: 650
    }
  };
  
  this.viewPort = {
    width: document.documentElement.clientWidth,
    height: document.documentElement.clientHeight,
    scrollBarY: window.innerWidth - document.documentElement.clientWidth,
    scrollBarX: window.innerHeight - document.documentElement.clientHeight,
  };
  this.uniqueIdLast = 0;
  
  this.header = {
    obj: document.querySelector( 'header.page-header' ),
    height: {
      no: 100,
      md: 110
    }
  }
  
  this.windowPageYOffsetLast = 0;
  
  this.sections = document.querySelectorAll( '.page-section' );
  
  var st = this;
  this.isSmallScreen = function( breakpoint ) {
    breakpoint = breakpoint || st.consts.breakpoint;
    return ( st.consts.breakpoints[ breakpoint ] > st.viewPort.width );
  };
  this.isSmallScreenNav = function() {
    return ( st.consts.breakpoints[ st.consts.breakpointNav ] > st.viewPort.width );
  };
  
  this.resize = function() {
    
    st.viewPort.width = document.documentElement.clientWidth;
    st.viewPort.height = document.documentElement.clientHeight;
    
    document.documentElement.style.setProperty('--vh',st.viewPort.height*.01+'px');
    document.documentElement.style.setProperty('--vw',st.viewPort.width*.01+'px');
    
    for ( var i = 0; i < this.sections.length; i++ ) {
      this.sections[i].style.width = st.viewPort.width + 'px';
    }
    
  };

  this.uniqueId = function( prefix ) {
    
    var id = '' + ++st.uniqueIdLast;
    return prefix ? prefix + id : 'st-' + id;
  };
    
  function init() {
    
    if ( window.st ) return false;
    
    document.documentElement.classList.add('st-initialized');
    if ( 'ontouchstart' in document.documentElement ) document.documentElement.classList.add('st-touch');
    if ( st.header.height.md <= window.pageYOffset ) document.documentElement.classList.add('st-scrolling');
    
    st.resize();
    
    return true;
  }
  init();
  
  window.st = window.st || this;
  
}
new Epiqk();

( function( $ ) {

  $( document ).ready( function() {

    $('div.wp-block-cover.is-style-hero').append('<b class="hero__cta">EXPLORE</b>');

    setTimeout(function() {
      $('.hero__cta').addClass('animate');
    }, 2500);

    $('.hero__cta').on('click', function() {
      $([document.documentElement, document.body]).animate({
        scrollTop: $('.hero__cta').parent().next().offset().top
      }, 1000);
    });

    $('h2 > sub').parent().addClass('horizontal-sup')

    $('.is-style-logo-overlay').append('<b class="logo-overlay"></b>');

    $('.has-plus-top-right, figure.wp-block-media-text__media').prepend('<b class="plus-parallax"></b>')

    st.resize();
      
    st.windowPageYOffsetLast = window.pageYOffset;


    //line parallax//

    const $parallaxFigures = $( '.logo-overlay');
    let limit = 20;

    const parallaxArrowsInit = () => {

      for( var i = 0; i < $parallaxFigures.length; i++ ) {
        $parallaxFigures[i].classList.add( 'observing-figure' );
      }
    }

    const parallaxArrowsAnimate = () => {
      $parallaxFigures.each(function() {
        
        const $figure = $(this);
        let offsetTop = $figure.offset().top, height = $figure.height();
        
        if ( window.pageYOffset + document.documentElement.clientHeight > offsetTop && window.pageYOffset < offsetTop + height ) {
          
          var start = offsetTop - document.documentElement.clientHeight, end =  offsetTop + height;
          var travel = ( window.pageYOffset - start ) / ( end - start );
          var transformOffset = (130 / 2) * travel;
          var ratio = (130 / 2);
          
          if(!st.isSmallScreenNav()) {
            transformOffset = (500 / 2) * travel;
            ratio = (500 / 2);
            limit = 0;
          }

          if(transformOffset < ratio - limit ) {
            $figure.css( 'transform', 'translateY(' + transformOffset + 'px)' );
          }

        }
      });
    }

    const $parallaxPlusFigures = $( '.plus-parallax');

    const parallaxPlusArrowsInit = () => {

      for( var i = 0; i < $parallaxPlusFigures.length; i++ ) {
        $parallaxPlusFigures[i].classList.add( 'observing-figure' );
      }
    }

    const parallaxArrowsPlusAnimate = () => {
      $parallaxPlusFigures.each(function() {
        
        const $figure = $(this);
        let offsetTop = $figure.offset().top, height = $figure.height();
        
        if ( window.pageYOffset + document.documentElement.clientHeight > offsetTop && window.pageYOffset < offsetTop + height ) {
          
          var start = offsetTop - document.documentElement.clientHeight, end =  offsetTop + height;
          var travel = ( window.pageYOffset - start ) / ( end - start );
          var transformOffset = (-130 / 2) * travel;
          var ratio = (130 / 2);
          
          if(!st.isSmallScreenNav()) {
            transformOffset = (-150 / 2) * travel;
            ratio = (150 / 2);
            limit = 0;
          }

          if(transformOffset < ratio - limit ) {
            $figure.css( 'transform', 'translateY(' + transformOffset + 'px)' );
          }

        }
      });
    }

    const $parallaxImgFigures = $( '.wp-block-media-text__media > img');

    const parallaxImgArrowsInit = () => {

      for( var i = 0; i < $parallaxImgFigures.length; i++ ) {
        $parallaxImgFigures[i].classList.add( 'observing-figure' );
      }
    }

    const parallaxArrowsImgAnimate = () => {
      $parallaxImgFigures.each(function() {
        
        const $figure = $(this);
        let offsetTop = $figure.offset().top, height = $figure.height();
        
        if ( window.pageYOffset + document.documentElement.clientHeight > offsetTop && window.pageYOffset < offsetTop + height ) {
          
          var start = offsetTop - document.documentElement.clientHeight, end =  offsetTop + height;
          var travel = ( window.pageYOffset - start ) / ( end - start );
          var transformOffset = (130 / 2) * travel;
          var ratio = (1300 / 2);
          
          if(!st.isSmallScreenNav()) {
            transformOffset = (150 / 2) * travel;
            ratio = (1000 / 2);
            limit = 0;
          }

          if(transformOffset < ratio - 0 ) {
            $figure.css( 'transform', 'translateY(' + transformOffset + 'px)' );
          }

        }
      });
    }
    
    $(window).on( 'load', function() {

      parallaxArrowsInit();
      parallaxArrowsAnimate();
      parallaxPlusArrowsInit();
      parallaxArrowsPlusAnimate();
      parallaxImgArrowsInit();
      parallaxArrowsImgAnimate();

    } ).on( 'resize orientationchange', function() {

      st.resize();
      if ( document.documentElement.classList.contains( 'toggle-main-nav' ) && !st.isSmallScreenNav() ) document.documentElement.classList.remove( 'toggle-main-nav', 'animate' );

      if ( !st.isSmallScreen() ) {

      } else {
        document.documentElement.classList.remove('scrolled');
      }

      parallaxArrowsAnimate();
      parallaxArrowsPlusAnimate();
      parallaxArrowsImgAnimate();
      
    } ).on( 'scroll', function( e ) {

      parallaxArrowsAnimate();
      parallaxArrowsPlusAnimate();
      parallaxArrowsImgAnimate();

      if ( 0 === window.pageYOffset ) document.documentElement.classList.remove( 'is-scrolling' );
      else document.documentElement.classList.add( 'is-scrolling' );

      if ( 0 === window.pageYOffset || st.windowPageYOffsetLast < window.pageYOffset ) document.documentElement.classList.remove( 'is-scrolling-up' );
      else document.documentElement.classList.add( 'is-scrolling-up' );

      st.windowPageYOffsetLast = window.pageYOffset;

      if ( 150 < window.pageYOffset ) {
        document.documentElement.classList.add('scrolled');
      } else {
        document.documentElement.classList.remove('scrolled');
      }

    } ).on( 'hashchange', function( e ) {
      
      if ( window.location.hash.match( /^#?!\// ) ) {
        
        e.preventDefault();
        st.hashParts = window.location.hash.replace( /\/$/, '').split('/');
        
        if ( 'string' === typeof st.hashParts[1] ) {
          
          if ( 'top' === st.hashParts[1] ) {
            
            $( 'html, body' ).stop( true ).animate( { scrollTop: 0 }, st.consts.transition.slow );
            if ( 'replaceState' in history ) history.replaceState( undefined, document.title, window.location.pathname );
            
          } else if ( 'undefined' === typeof st.hashParts[2] && $( '#' + st.hashParts[1] ).length ) {
            
            var $target = $( '#' + st.hashParts[1] );
            $('html, body').stop( true ).animate( { scrollTop: $target.offset().top }, st.consts.transition.slow, function() {
              
            } );
          
          } else if ( st.hashParts[1].length && 'string' === typeof st.hashParts[2] ) {
            
            if ( 0 < st.hashParts[2].length ) {
              
              switch( st.hashParts[1] ) {
                case '':                
                  break;
              }

            }

          }

          if ( document.documentElement.classList.contains( 'toggle-main-nav' ) ) document.documentElement.classList.remove( 'toggle-main-nav' );
          
        }
        return false;
      }
      
    } ).trigger( 'scroll' );
    if ( window.location.hash.length ) $( window ).trigger( 'hashchange' );

    $( '#toggle-main-nav' ).on( 'click', function( e ) {
      
      e.preventDefault();
      
      if ( document.documentElement.classList.contains( this.id ) ) {
        document.documentElement.classList.remove( 'animate' );
        document.documentElement.classList.remove( this.id );
        document.getElementById( this.id ).setAttribute('aria-expanded', false);
      } else {
        document.documentElement.classList.add( this.id );
        document.getElementById( this.id ).setAttribute('aria-expanded', true);
        setTimeout(function() {
          document.documentElement.classList.add( 'animate' );
        }, 150);
      }
      
    } );

    const $menuItemContainers = $('.nav__main-wrap > div > ul > li');
    let $prevDelay = 0.15;

    $menuItemContainers.each(function() {
      $(this).css('transition-delay', `${$prevDelay}s`);
      $prevDelay += 0.15;
    });

    var submenus = document.body.querySelectorAll('.menu-item-has-children');
    for (var i = 0; i < submenus.length; i++) {
      submenus[i].addEventListener('click', function(e){
        if ( $(this).hasClass('sub-menu-toggled') ) {
          $(this).removeClass('sub-menu-toggled');
        } else {
          $(this).addClass('sub-menu-toggled');
        }
      }); 
    }

    const $heroItems = $('header.header, .wp-block-cover.is-style-hero > div.wp-block-cover__inner-container > *, .hero__cta');
    let $heroDelay = 0.25;
    $('.is-style-hero').addClass('animate');
    $('header.header').addClass('loaded');

    $heroItems.each(function() {
      $(this).css('transition-delay', `${$heroDelay}s`);
      $heroDelay += 0.4;
    });

    setTimeout(function() {
      $heroItems.each(function() {
        $(this).css('transition-delay', `0s`);
      });
    }, 7000);

    $('h1 > strong').parent().addClass('fader');

    //lity on video link//
    $('.wp-block-button__link').each( function() {
      var is_video = false;
      if ( 'string' === typeof this.href ) {
        if ( -1 !== this.href.indexOf( 'youtu.be' ) ) is_video = true;
        // if ( -1 !== this.href.indexOf( '.youtube.' ) ) is_video = true;
        if ( -1 !== this.href.indexOf( '.mp4' ) ) is_video = true;
        if ( -1 !== this.className.indexOf( 'button-video' ) ) is_video = true;
        if ( -1 !== this.parentNode.className.indexOf( 'button-video' ) ) is_video = true;
      }
      if ( true === is_video && 'function' === typeof lity ) {
        if ( -1 === this.className.indexOf( 'button-video' ) ) this.className += ' button-video';
        this.setAttribute( 'data-lity-extra' , 'true' );
      }
    } );
    $( document ).on( 'click', '[data-lity-extra]', lity);

    //copy blog link
    $('#copy-link').on('click', function(e) {
      e.preventDefault();
      var text = $(this).attr('value');
      var elem = document.createElement("textarea");
      document.body.appendChild(elem);
      elem.value = text;
      elem.select();
      document.execCommand('copy');
      document.body.removeChild(elem);
      if(! $('#copied-clipboard').length ) {
        $(this).closest('div').append('<span id="copied-clipboard">URL copied to clipboard</span>');
        $('#copied-clipboard').delay(2000).fadeOut('slow', function() {
          // console.log($(this)[0]);
          $(this)[0].remove();
        });
      }
    });

    $('.slider__slides').each(function() {
      const $this = $(this);
      $this.slick({
        infinite: false,
        slidesToScroll: 1,
        slidesToShow: 1,
        dots: true,
        arrows: true,
        prevArrow: '<button type="button" class="slick-prev"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15.99 14.62"><defs><style>.cls-1{fill:none;stroke:#00a9e0;stroke-miterlimit:10}</style></defs><g id="Layer_2" data-name="Layer 2"><g id="Artwork"><path class="cls-1" d="M7.66.35.71 7.31l6.95 6.96M.71 7.31h15.28"/></g></g></svg></button>',
        nextArrow: '<button type="button" class="slick-next"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15.99 14.62"><defs><style>.cls-1{fill:none;stroke:#00a9e0;stroke-miterlimit:10}</style></defs><g id="Layer_2" data-name="Layer 2"><g id="Artwork"><path class="cls-1" d="m8.33.35 6.95 6.96-6.95 6.96M15.28 7.31H0"/></g></g></svg></button>',  
        appendArrows: $this.parent().find('.slider__buttons'),
        appendDots: $this.parent().find('.slider__nav'),
        fade: false,
        centerMode: false,
        mobileFirst: true,
        responsive: [
          {
            breakpoint: 959,
            settings: {
              slidesToShow: 2,
            }
          }
        ]
      });
    });

    //team

    const $members = $('.team__member');
    const $teamButtons = $('.team__nav__button');

    $members.each(function() {
      $(this).fadeOut();
    });

    $members.first().fadeIn().addClass('active');
    $teamButtons.first().addClass('active');

    const resetButtons = () => {
      $teamButtons.each(function() {
        $(this).removeClass('active');
      });
    }

    const closeActiveMember = () => {
      $members.each(function() {
        const $this = $(this);
        if($this.hasClass('active')) {
          $this.fadeOut().removeClass('active');
        }
      });
    }

    const openMember = (id) => {
      $members.each(function() {
        const $this = $(this);

        if($this.attr('id') == id) {
          $this.fadeIn().addClass('active');
        }
      });
    }

    $('.team__nav__button').on('click', function() {
      const $this = $(this);
      const id = $this.attr('data-name');

      if(!$this.hasClass('active')) {
        closeActiveMember();
        resetButtons();

        setTimeout(function() {
          $this.addClass('active');
          openMember(id);
        }, 500);
      }
    });

    
    
    //accordions
    const $accordions = $('.accordion__item');

    $accordions.each(function() {
      const $this = $(this);

      const $content = $this.find('.accordion__item__content')
      $content.slideUp();

      $this.find('button').on('click', function(e) {
        e.preventDefault();

        if($this.hasClass('toggled')) {
          $this.removeClass('toggled');
          $content.slideUp();
        } else {
          $this.addClass('toggled');
          $content.slideDown();
        }
      });
    });

    //Projects Sort Form
    const $sortForm = $('#projects-sort');

    $sortForm.on('submit' ,function(e) {
      $(this)[0].action = `${window.location.origin}/projects`;
    });

    $('#service').on('change', function() {
      $sortForm.trigger('submit');
    });

    $('#industry').on('change', function() {
      $sortForm.trigger('submit');
    });

    $('.projects__teaser > a').on('click', function() {
      const $this = $(this);
      const id = $this.data('id');
      let $populated = $this.data('populated');
      const $lightbox = $(`#project${id}`);

      $.ajax( {
        url: `/wp-json/epiqk/v1/projects/${id}`,
        success: function ( data ) {
          if(data) {
            if(0 == $populated) {
              
              if(data.material) {
                data.material.forEach(function(cat) {
                  $lightbox.find('ul.projects__lightbox__materials').append(`<li>${cat.name}</li>`)
                });
              }

              console.log(data);

              if(data.the_content) {
                $lightbox.find('div.projects__lightbox__content').append(data.the_content);
              }

              if(data.image || data.acf.image_gallery) {
                if(data.acf.image_gallery) {
                  data.acf.image_gallery.forEach(function(img) {
                    if(img.image && img.image.sizes.large) {
                      $lightbox.find('.projects__lightbox__slider > ul').append(`<li><img src="${img.image.sizes.large}"></li>`);
                    }
                  });
                }
                const $slider = $lightbox.find('.projects__lightbox__slider > ul');
                $slider.slick({
                  infinite: true,
                  slidesToShow: 1,
                  arrows: true,
                  prevArrow: $slider.parent().find('.prev'),
                  nextArrow: $slider.parent().find('.next'),
                });
                $slider.fadeIn();
                $slider.next().fadeIn();
                $slider.parent().next().children().each(function() {
                  $(this).css('transform', 'translate(0)');
                  $(this).css('opacity', '1');
                })
              } else {
                $lightbox.find('.projects__lightbox__slider').hide();
              }

            } else {

              if(data.acf.image_gallery) {
                $lightbox.find('.projects__lightbox__slider > ul').slick('refresh');
              }

            }
          }
          $this.data('populated', "1");
        },
        cache: false
    } );
  });

  $( '.next-page-link-wrapper-projects > div > a' ).on( 'click', function( event ) {
    event.preventDefault();

    var $this = $(this), _this = this, pageCurrent = 1;

    if ( _this.classList.contains( 'rest-initialized' ) ) return false;
    _this.classList.add( 'rest-initialized' );

    var cardContainer = _this.parentElement.parentElement.previousElementSibling;

    if ( this.dataset.pageCurrent ) pageCurrent = parseInt( _this.dataset.pageCurrent );

    $.ajax({
      url: '/wp-json/wp/v1/projects?&page=' + ( pageCurrent + 1 ),
      method: 'GET',
      beforeSend: function(xhr){

        $this.addClass( 'rest-running' );
        //xhr.setRequestHeader( 'X-WP-Nonce', wpApiSettings.nonce );

      }
    }).done( function( data, textStatus, jqXHR ) {

      pageCurrent++
      if ( parseInt( jqXHR.getResponseHeader( 'x-wp-totalpages' ) ) > pageCurrent ) {
        _this.dataset.pageCurrent = pageCurrent;
      } else {
        _this.parentNode.removeChild( _this );
      }

      if ( data.length ) {

        for ( var i = 0; i < data.length; i++ ) {

          
          let template = document.createElement( 'template' );
          template.innerHTML = data[i].card;
          
          let card = template.content.firstChild;
          card.classList.add( 'observing' );
          cardContainer.appendChild( template.content.firstChild );
          window.setTimeout( function() { card.classList.add( 'intersected' ); }, 75 + ( i * 125 ) );

        }

      }

      _this.dataset.pageCurrent = pageCurrent;
      
    }).fail( function( jqXHR, textStatus, errorThrown ) {

      _this.parentNode.removeChild( _this );

    } ).always( function( data_or_jqXHR, textStatus, jqXHR_or_errorThrown ) {

      _this.classList.remove( 'rest-initialized' );
      _this.classList.remove( 'rest-running' );

    } );

  } ).text( 'Load More' );
    


    //form with google recaptcha v3

    // $( 'footer.page-footer form' ).on( 'submit', function( e ) {
    //   e.preventDefault();
  
    //   var $this = $(this);
        
    //   if ( !$this.children( 'input[type="email"]' ).val().length || -1 === $this.children( 'input[type="email"]' ).val().indexOf('@') ) return false;

    //   grecaptcha.ready(function() {
    //     grecaptcha.execute('_SITE KEY HERE_', {action: 'footer_signup'}).then(function(token) {
          
    //           $('#footer-form').prepend('<input type="hidden" name="token" value="' + token + '">');
    //           $('#footer-form').prepend('<input type="hidden" name="action" value="footer_signup">');
              
    //           var post = $.ajax({
    //             type: 'POST',
    //             url: '/wp-json/' + st.consts.namespace + '/v1/signup',
    //             data: { token: $this.find('input[name="token"]').val(), action: $this.find('input[name="action"]').val(),  email: $this.find( 'input[type="email"]' ).val() },
    //             dataType: 'json'
    //           });
              
    //           post.done( function() {
    //             var $response = $( '<form><p>Thanks for subscribing!</p></form>' );
    //             $this.replaceWith( $response );
    //             setTimeout( function() {
    //               $response.fadeOut( 625, function() {
    //                 $(this).remove();
    //               } );
    //             }, 10000 );
    //           })
    //           .fail( function() {
    //             $this.replaceWith( '<form><p>Error processing subscription! Please <a href="/connect/">contact us</a></p></form>' );
    //           })
    //       });
    //   });      
    //   return false;
    // } );

    //load more posts
    $( '.next-page-link-wrapper > a' ).on( 'click', function( event ) {
      event.preventDefault();

      var $this = $(this), _this = this, pageCurrent = 1;

      if ( _this.classList.contains( 'rest-initialized' ) ) return false;
      _this.classList.add( 'rest-initialized' );

      if ( this.parentElement.dataset.pageCurrent ) pageCurrent = parseInt( _this.parentElement.dataset.pageCurrent );

      var restUrl = '/wp-json/wp/v2/posts?';
      if ( _this.parentElement.dataset.perPage ) restUrl = restUrl + 'per_page=' + _this.parentElement.dataset.perPage + '&';
      if ( _this.dataset.exclude ) restUrl = restUrl + 'exclude=' + _this.dataset.exclude + '&';
      if ( _this.dataset.term ) restUrl = restUrl + 'categories=' + _this.dataset.term + '&';

      $.ajax({
        url: restUrl + 'page=' + ( pageCurrent + 1 ),
        method: 'GET',
        beforeSend: function(xhr){

          $this.addClass( 'rest-running' );
          //xhr.setRequestHeader( 'X-WP-Nonce', wpApiSettings.nonce );

        }
      }).done( function( data, textStatus, jqXHR ) {

        pageCurrent++

        if ( data.length ) {

          for ( var i = 0; i < data.length; i++ ) {

            let template = document.createElement( 'template' );
            template.innerHTML = data[i].card;

            let card = template.content.firstChild;
            card.classList.add( 'observing' );

            _this.parentElement.parentElement.parentElement.querySelectorAll('.blog__list')[0].appendChild(
              template.content.firstChild,

            );

            window.setTimeout( function() { card.classList.add( 'intersected' ); }, 75 + ( i * 125 ) );

          }

        }

        if ( parseInt( jqXHR.getResponseHeader( 'x-wp-totalpages' ) ) > pageCurrent ) {
          _this.parentElement.dataset.pageCurrent = pageCurrent;
        } else {
          _this.parentNode.removeChild( _this );
        }

        // _this.dataset.pageCurrent = pageCurrent + 1;
        
      }).fail( function( jqXHR, textStatus, errorThrown ) {

        _this.parentNode.removeChild( _this );

      } ).always( function( data_or_jqXHR, textStatus, jqXHR_or_errorThrown ) {

        _this.classList.remove( 'rest-initialized' );
        _this.classList.remove( 'rest-running' );

      } );

    } ).text( 'Load More' );



    if ( 'IntersectionObserver' in window ) {
  
      var observeSection = new IntersectionObserver( function( entries ) {
        
        entries.forEach( function( entry ) {
        
          var content = entry.target;
          if ( entry.isIntersecting ) {
            
            content.classList.add( 'intersected' );
            content.classList.add( 'intersecting' );
            
          } else {
            
            content.classList.remove( 'intersecting' );

            if ( content.classList.contains( 'intersected' ) ) observeSection.unobserve( content );
            
          }
          
        });
        
      }, {
        threshold: 0.1
      });
      
      var contentNodes = document.querySelectorAll( '.content, .wp-block-column > *:not(div), .wp-block-button, .wp-block-group__inner-container > *:not(div), .wp-block-media-text__content > *:not(div), .is-style-collaborations .wp-block-image, .services__item' );
      for( var i = 0; i < contentNodes.length; i++ ) {
        contentNodes[i].classList.add( 'observing' );
        observeSection.observe( contentNodes[i] );
      }
      
    }
      
  } );

} )( jQuery );

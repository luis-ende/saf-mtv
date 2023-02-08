@props(['productos' => []])

<div class="w-full font-bold text-xl text-mtv-text-gray border-b-2">
    Productos relacionados
</div>

<!-- Carousel --> 
<div class="my-4">    
    <style>
      .scroll-snap-x {
        scroll-snap-type: x mandatory;
      }
  
      .snap-center {
        scroll-snap-align: center;
      }
  
      .no-scrollbar::-webkit-scrollbar {
        display: none;
      }
  
      .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
      }
    </style>    
  
    <div class="mt-12 flex mx-auto items-center">
      <div x-data="carousel()" x-init="init()" class="relative overflow-hidden group">
        <div x-ref="container"
             class="md:-ml-4 md:flex md:overflow-x-scroll scroll-snap-x md:space-x-2 space-y-2 md:space-y-0 no-scrollbar">
            @foreach($productos as $producto)  
                <div
                    class="ml-4 flex-auto flex-grow-0 flex-shrink-0 w-72 items-center justify-center snap-center overflow-hidden p-3">
                    <x-productos.producto-card
                        :producto="$producto"
                        modo="visitante" />                    
                </div>          
            @endforeach  
        </div>
        <div @click="scrollTo(prev)" x-show="prev !== null"
             class="hidden md:block absolute top-1/2 left-0 bg-white p-2 rounded-full transition-transform ease-in-out transform -translate-x-full -translate-y-1/2 group-hover:translate-x-0 cursor-pointer">
          <div>@svg('ri-arrow-left-s-fill', ['class' => 'w-5 h-5'])</div>
        </div>
        <div @click="scrollTo(next)" x-show="next !== null"
             class="hidden md:block absolute top-1/2 right-0 bg-white p-2 rounded-full transition-transform ease-in-out transform translate-x-full -translate-y-1/2 group-hover:translate-x-0 cursor-pointer">
             <div>@svg('ri-arrow-right-s-fill', ['class' => 'w-5 h-5'])</div>
        </div>
      </div>
    </div>      

    <script>
        window.carousel = function () {
          return {
            container: null,
            prev: null,
            next: null,
            init() {
              this.container = this.$refs.container
    
              this.update();
    
              this.container.addEventListener('scroll', this.update.bind(this), {passive: true});
            },
            update() {
              const rect = this.container.getBoundingClientRect();
    
              const visibleElements = Array.from(this.container.children).filter((child) => {
                const childRect = child.getBoundingClientRect()
    
                return childRect.left >= rect.left && childRect.right <= rect.right;
              });
    
              if (visibleElements.length > 0) {
                this.prev = this.getPrevElement(visibleElements);
                this.next = this.getNextElement(visibleElements);
              }
            },
            getPrevElement(list) {
              const sibling = list[0].previousElementSibling;
    
              if (sibling instanceof HTMLElement) {
                return sibling;
              }
    
              return null;
            },
            getNextElement(list) {
              const sibling = list[list.length - 1].nextElementSibling;
    
              if (sibling instanceof HTMLElement) {
                return sibling;
              }
    
              return null;
            },
            scrollTo(element) {
              const current = this.container;
    
              if (!current || !element) return;
    
              const nextScrollPosition =
                element.offsetLeft +
                element.getBoundingClientRect().width / 2 -
                current.getBoundingClientRect().width / 2;
    
              current.scroll({
                left: nextScrollPosition,
                behavior: 'smooth',
              });
            }
          };
        }
      </script>
</div>

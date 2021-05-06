<div class="item-layout item-list-layout-1">
    <div class="card card-category card-item border-0">
    <div class="row align-items-center">
      @if(method_exists ( $item, "mediaFiles" ) )
            <div class="col-12 {{$orderClasses["photo"] ?? 'order-0'}} item-image">
        <x-media::single-image :alt="$item->title ?? $item->name" :title="$item->title ?? $item->name" :
                               :url="$item->url ?? null" :isMedia="true" width="100%"
                               :mediaFiles="$item->mediaFiles()" :zone="$mediaImage ?? 'mainimage'"/>
      
      </div>
      @endif
            <div class="col-12 {{$orderClasses["title"] ?? 'order-1'}} item-title">
        @if(isset($item->url))
          <a href="{{$item->url}}">
            @endif
            <h3 class="title">
              {{$item->title ?? $item->name}}
            </h3>
            @if(isset($item->url))
          </a>
        @endif
      </div>
      @if($withCreatedDate && isset($item->created_at))
                <div class="col-12 {{$orderClasses["date"] ?? 'order-2'}} item-created-date">
          @if(isset($item->url))
            <a href="{{$item->url}}">
              @endif
                            <div class="created-date">{{ $item->created_at->format($formatCreatedDate) }}</div>
              @if(isset($item->url))
            </a>
          @endif
        </div>
      @endif
            @if($withCategory && isset($item->category->id))
                <div class="col-12 {{$orderClasses["categoryTitle"] ?? 'order-3'}} item-category">
          @if(isset($item->category->url))
            <a href="{{$item->category->url}}">
              @endif
                            <h5 class="category">
                {{$item->category->title ?? $item->category->name}}
              </h5>
              @if(isset($item->category->url))
            </a>
          @endif
        </div>
      @endif
            @if($withSummary && ( isset($item->summary) || isset($item->description) || isset($item->custom_html)) )
                <div class="col-12 {{$orderClasses["summary"] ?? 'order-4'}} item-summary">
          @if(isset($item->url))
            <a href="{{$item->url}}">
              @endif
                            <div class="summary">
                                {!! Str::limit( $item->summary ?? $item->description ?? $item->custom_html ?? '', $numberCharactersSummary) !!}
              </div>
              @if(isset($item->url))
            </a>
          @endif
        </div>
      @endif
      @if($withViewMoreButton)
                <div class="col-12 {{$orderClasses["viewMoreButton"] ?? 'order-5'}} item-view-more-button">
          @if(isset($item->url))
                        <a href="{{$item->url}}" class="btn view-more-button">
              @endif
              {{trans($viewMoreButtonLabel)}}
              @if(isset($item->url))
            </a>
          @endif
        </div>
      @endif
    </div>
  
  </div>
</div>
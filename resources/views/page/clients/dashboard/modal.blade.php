@if ($video['status_id'] == 1)
    <div class="modal fade" id="dashModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <video width="800" height="800" src="{{ asset($video['src'].$video['name']) }}" controls autoplay muted> </video>
        </div>
    </div>
@endif
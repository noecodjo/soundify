<div class="col-lg-3 col-sm-6 text-xs-center">
    <a href="/users/{{ $item->username }}">
        <div class="card">
            <img class="card-img-top img-fluid" src="{{ $item->avatarPath() }}" alt="{{ $item->username }}'s picture">
            <div class="card-block">
                <p class="card-text">{{ $item->username }}</p>
            </div>
        </div>
    </a>
</div>
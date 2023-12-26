  <?php $segment = request()->segment(count(request()->segments())); ?>
  <section class="vi-user-profile-section">
      <div class="vigrid-wide">
          <div class="vi-user-profile-tab-wrapper">
              <div class="vi-profile-tab-list">
                  <a href="{{ route('user.dashboard') }}"
                      class="tab-item tab-activity {{ $segment == 'activity' ? 'active' : '' }}">Activity</a>
                  <a href="{{ route('bookmarks') }}"
                      class="tab-item tab-activity {{ $segment == 'bookmarks' ? 'active' : '' }}"">Bookmarks </a>
                  <a href="{{ route('user.content') }}"
                      class="tab-item tab-my-content {{ $segment == 'content' ? 'active' : '' }}"">My Content</a>
                  <div class="tab-item tab-leaderboard">Leaderboard</div>
              </div>

          </div>
      </div>
  </section>

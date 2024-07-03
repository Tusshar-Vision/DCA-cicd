  <?php $segment = request()->segment(count(request()->segments())); ?>
  <section class="vi-user-profile-section">
      <div class="vigrid-wide">
          <div class="vi-user-profile-tab-wrapper flex-none justify-start lg:flex lg:justify-between">
              <div class="vi-profile-tab-list">
                  <a href="{{ route('user.dashboard') }}"
                     class="tab-item tab-activity {{ $segment == 'activity' ? 'active' : '' }}"
                     wire:navigate
                  >
                      Activity
                  </a>
                  <a href="{{ route('bookmarks') }}"
                     class="tab-item tab-activity {{ $segment == 'bookmarks' ? 'active' : '' }}"
                     wire:navigate
                  >
                      Bookmarks
                  </a>
                  {{-- <a href="{{ route('user.content') }}"
                      class="tab-item tab-my-content {{ $segment == 'content' ? 'active' : '' }}"">My Content</a>
                  <div class="tab-item tab-leaderboard">Leaderboard</div> --}}
              </div>
              <!-- right side tab link newly added -->
              {{-- <ul class="flex justify-start mt-[30px] xl:mt-0 xl:justify-between text-[16px] text-[#8F93A3]">
                <li><a href="javascript:void(0)" class="hover:text-[#3362CC] activeSubTab">Note</a></li>
                <li><a href="javascript:void(0)" class="ml-5 hover:text-[#3362CC]">Draft</a></li>
                <li><a href="javascript:void(0)" class="ml-5 hover:text-[#3362CC]">Delete</a></li>
              </ul> --}}
              <!-- right side tab link newly added -->
          </div>

      </div>
  </section>

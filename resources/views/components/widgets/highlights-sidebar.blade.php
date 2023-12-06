<div class="vi-highlights-sidebar">
    <div class="vi-announcement-wrap">
        <h5 class="vi-sidebar-title">What’s New</h5>
        <div class="vi-announcement-card">
            <p class="vi-announcement-title">Announcements</p>
            <ul>
                @foreach($announcements as $announcement)
                    <li>{!! $announcement->content !!}</li>
                @endforeach
            </ul>
        </div>
        <div class="vi-announcement-card">
            <p class="vi-announcement-title">News Updates</p>
            <ul>
                <li><span>Global Multidimensional Poverty Index (MPI) 2023 unveiled by United Nations Development Program (UNDP)</span>
                    <div class="hidden-text">Global Multidimensional Poverty Index (MPI) 2023 unveiled by Unit Global Multidimensional Poverty Index (MPI) 2023 unveiled by Unit</div>
                </li>
                <li>Roadmap for Green Hydrogen Ecosystem in India by Ministry of New and Renewable Energy
                <div class="hidden-text">Global Multidimensional Poverty Inde</div>
                </li>
            </ul>
        </div>
    </div>
</div>


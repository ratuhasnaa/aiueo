<section class="flat-row flat-imagebox background">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="flat-row-title center">
							<h2>Flexible Workspace Designed Around Your Needs</h2>
						</div><!-- /.flat-row-title -->
						<!-- New Icons Section -->
						<div class="icons-section">
							<div class="icon-item icon-item1" id="icon-office-space" onclick="showContent('content-office-space')">
								<img src="images/page/office1.svg" alt="Office Space">
								<span>Office Space</span>
							</div>
							<div class="icon-item icon-item2" id="icon-coworking" onclick="showContent('content-coworking')">
								<img src="images/page/coworking.svg" alt="Coworking">
								<span>Coworking</span>
							</div>
							<div class="icon-item icon-item3" id="icon-virtual" onclick="showContent('content-virtual')">
								<img src="images/page/online.svg" alt="Virtual Office">
								<span>Virtual Office</span>
							</div>
							<div class="icon-item icon-item4" id="icon-meeting-rooms" onclick="showContent('content-meeting-rooms')">
								<img src="images/page/meeting.svg" alt="Meeting Rooms">
								<span>Meeting Rooms</span>
							</div>
						</div>
						<div class="center-line"></div> <!-- Centered grey line -->
					</div>
				</div><!-- /.col-md-12 -->
				


 <!--------------------------- CONTENT SECTION ---------------------------------------------->
 <div id="content-office-space" class="content-section active">
    <div class="row">
        @forelse($room->where('room_type', 'office-space') as $officeRoom)
        <div class="col-md-3">
            <div class="imagebox">
                <div class="box-imagebox">
                    <div class="box-header">
                        <div class="box-image">
                        @if($officeRoom->images->isNotEmpty())
                            <img src="{{ asset('room/' . $officeRoom->images->first()->image) }}" alt="{{ $officeRoom->room_title }}">
                        @else
                            <img src="path/to/default-image.jpg" alt="Default Image">
                        @endif
                            <a href="#" title="">Preview</a>
                            <div class="overlay"></div>
                        </div>
                    </div>
                    <div class="box-content">
                        <div class="box-title-rating">
                            <a href="{{ url('room_details', $officeRoom->id) }}" title="">{{ $officeRoom->room_title }}</a>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <span class="score">4.5</span>
                            </div>
                        </div>
                        <div class="box-info">
                            <li class="address">{{$officeRoom->location}}</li>
                            <li class="price">Rp 800.000</li>
                        </div>
                        <div class="box-buttons">
                            <a href="{{ url('room_details', $officeRoom->id) }}" class="button">Book</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-md-12 text-center">
            <p>Sorry, no office spaces available at the moment.</p>
        </div>
        @endforelse
    </div>
</div>

<div id="content-coworking" class="content-section">
    <div class="row">
        @forelse($room->where('room_type', 'coworking') as $coworkingRoom)
        <div class="col-md-3">
            <div class="imagebox">
                <div class="box-imagebox">
                    <div class="box-header">
                        <div class="box-image">
                        @if($coworkingRoom->images->isNotEmpty())
                            <img src="{{ asset('room/' . $coworkingRoom->images->first()->image) }}" alt="{{ $coworkingRoom->room_title }}">
                        @else
                            <img src="path/to/default-image.jpg" alt="Default Image">
                        @endif
                            <a href="#" title="">Preview</a>
                            <div class="overlay"></div>
                        </div>
                    </div>
                    <div class="box-content">
                        <div class="box-title-rating">
                            <a href="{{ url('room_details', $coworkingRoom->id) }}" title="">{{ $coworkingRoom->room_title }}</a>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <span class="score">4.5</span>
                            </div>
                        </div>
                        <div class="box-info">
                            <li class="address">{{$coworkingRoom->location}}</li>
                            <li class="price">Rp {{ number_format($coworkingRoom->price, 0, ',', '.') }}</li>
                        </div>
                        <div class="box-buttons">
                            <a href="{{ url('room_details', $coworkingRoom->id) }}" class="button">Book</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-md-12 text-center">
            <p>Sorry, no coworking spaces available at the moment.</p>
        </div>
        @endforelse
    </div>
</div>

<div id="content-virtual" class="content-section">
    <div class="row">
        @forelse($room->where('room_type', 'virtual-office') as $virtualRoom)
        <div class="col-md-3">
            <div class="imagebox">
                <div class="box-imagebox">
                    <div class="box-header">
                        <div class="box-image">
                        @if($virtualRoom->images->isNotEmpty())
                            <img src="{{ asset('room/' . $virtualRoom->images->first()->image) }}" alt="{{ $virtualRoom->room_title }}">
                        @else
                            <img src="path/to/default-image.jpg" alt="Default Image">
                        @endif
                            <a href="#" title="">Preview</a>
                            <div class="overlay"></div>
                        </div>
                    </div>
                    <div class="box-content">
                        <div class="box-title-rating">
                            <a href="{{ url('room_details', $virtualRoom->id) }}" title="">{{ $virtualRoom->room_title }}</a>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <span class="score">4.5</span>
                            </div>
                        </div>
                        <div class="box-info">
                            <li class="address">{{$virtualRoom->location}}</li>
                            <li class="price">Rp 800.000</li>
                        </div>
                        <div class="box-buttons">
                            <a href="{{ url('room_details', $virtualRoom->id) }}" class="button">Book</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-md-12 text-center">
            <p>Sorry, no virtual offices available at the moment.</p>
        </div>
        @endforelse
    </div>
</div>

<div id="content-meeting-rooms" class="content-section">
    <div class="row">
        @forelse($room->where('room_type', 'meeting-room') as $meetingRoom)
        <div class="col-md-3">
            <div class="imagebox">
                <div class="box-imagebox">
                    <div class="box-header">
                        <div class="box-image">
                        @if($meetingRoom->images->isNotEmpty())
                            <img src="{{ asset('room/' . $meetingRoom->images->first()->image) }}" alt="{{ $meetingRoom->room_title }}">
                        @else
                            <img src="path/to/default-image.jpg" alt="Default Image">
                        @endif
                            <a href="#" title="">Preview</a>
                            <div class="overlay"></div>
                        </div>
                    </div>
                    <div class="box-content">
                        <div class="box-title-rating">
                            <a href="{{ url('room_details', $meetingRoom->id) }}" title="">{{ $meetingRoom->room_title }}</a>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <span class="score">4.5</span>
                            </div>
                        </div>
                        <div class="box-info">
                            <li class="address">{{$meetingRoom->location}}</li>
                            <li class="price">Rp {{ number_format($meetingRoom->price, 0, ',', '.') }}</li>
                        </div>
                        <div class="box-buttons">
                            <a href="{{ url('room_details', $meetingRoom->id) }}" class="button">Book</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-md-12 text-center">
            <p>Sorry, no meeting rooms available at the moment.</p>
        </div>
        @endforelse
    </div>
</div>


			</div><!-- /.container -->
		</section><!-- /.flat-imagebox style2 -->
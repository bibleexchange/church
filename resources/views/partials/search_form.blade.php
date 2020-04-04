		 <form action="{{ url('/bible/search') }}" class="form-inline my-2 my-lg-0" method="post" role="search" id="main-search">
				@csrf

				<div class="input-group">
					<span class="input-group-btn">
						<button type="submit" class="btn btn-default">
							<span class="fa fa-search">
								<span class="sr-only">Search...</span>
							</span>
						</button>
					</span>
					<input type="text" name="search" id="q" placeholder="Search..." name="redirect" class='form-control ellip' value="{{ old('search') }}" />

				</div>
			</form>

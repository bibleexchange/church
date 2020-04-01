		 <form action="{{ url('/bible/search') }}" class="navbar-form" method="post" role="search" id="main-search">
				@csrf

				<div class="input-group">
					<span class="input-group-btn">
						<button type="submit" class="btn btn-default">
							<span class="glyphicon glyphicon-search">
								<span class="sr-only">Search...</span>
							</span>
						</button>
					</span>
					<input type="text" name="search" id="q" value={{old('search')}} placeholder="Search..." name="redirect" class='form-control ellip'/>

				</div>
			</form>

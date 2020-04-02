@extends('layouts.app')

@section('content')

            <div class="card">
                <div class="contents">


                    <h2 style="margin-bottom:15px;">All people welcome.</h2>

                    <img src="/img/church-doors.jpg" style="width:90%; margin:auto;"/>
					
                    
                </div>

				<div class="contents">

				<h2>WE ARE</h2>

				<p>Deliverance Center is a Bible believing church family located on Route 1 just across the town line of Arundel, Maine. We are a Full Gospel local church preaching the living Christ to a dying world!</p>

				<hr />
				
				<iframe width="560" height="315" src="https://www.youtube.com/embed/WsSoAiPz-Fg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

				<p><a href="/blog">more</a></p>

				<hr />
				<h2>LIVE STREAM</h2>

				<p>We stream live audio of all of our church services for those that are unable to physically join us. The audio should automatically start playing on this page if the on air signal is displaying.</p>

				<p>If the stream is not on air during the scheduled times, we may be experiencing technical difficulty.</p>

				<p>To report any problem with the stream, please visit our Facebook page or send us a Tweet and let us know what's going on. We will try to respond and fix the problem as soon as possible.</p>

				<hr />
				<h2>Our Senior Pastor</h2>

				<img  style="width:150px;" src="/img/sgrsr-preaching.jpg" />
				<img  style="width:150px;" src="/img/sgrsr-april.jpg" style="margin-bottom:50px"/>
				<img  style="width:150px;" src="/img/april-singing.jpg" />
				
				
				<p>Stephen Reynolds, Sr. (Gospel Preacher 45+ Years) and his lovely wife April Reynolds. </p>

				<hr />

				<h2>Our Heritage</h2>
				
				<img  style="width:150px;" src="/img/jrrsr.png" ALIGN="left"/>

				<p>The late Rev. James R. Reynolds, Sr. founded the Deliverance Center in 1967 at 1008 Congress Street in Portland, Maine with the aid of several volunteers. In time, Rev. Reynolds' own family members have become a part of daily functions at the Deliverance Center along with several very dedicated volunteers.</p>
<img  style="width:150px;" src="/img/jrrsr-family.jpg"  ALIGN="right"/>

				<p>Initially, the Deliverance Center helped and worked for the transformation of alcoholics and drug addicts. This focus is especially seen in its name, as being a place of deliverance from any bondage of sin.</p>
				<img  style="width:150px;" src="/img/singing-in-tent.jpg"  ALIGN="left"/>
				<p>The Deliverance Center was birthed as a local church out of this "street ministry" and practical help.</p>

				<p>In 1969, DC expanded to include an educational facility. The first of its schools, Deliverance Bible Institute, was established to train young adults for Christian service in a three-year course. From 1979-2010, Christian Academy of Portland extended the student body and curriculum to include grades K-12. Today, Deliverance Bile Institute and the education vision of Deliverance Center is realized through Bible exchange.</p>

				<img  style="width:150px;" src="/img/mark-singing.jpg"  style="width:100%;"/>

				<hr />
				<!-- <h2>Memories</h2>
				<div class='embedsocial-album' data-ref="189a83d9d27ab7f664e6e5e1200a5eb52b1b6556"></div><script>(function(d, s, id){var js; if (d.getElementById(id)) {return;} js = d.createElement(s); js.id = id; js.src = "https://embedsocial.com/embedscript/ei.js"; d.getElementsByTagName("head")[0].appendChild(js);}(document, "script", "EmbedSocialScript"));</script>

				
				<hr />
				-->

				<h2>Missions - The Gospel is for All</h2>

				

				<p>From the Streets of America to Africa</p>

				<iframe width="680" height="400" src="https://www.youtube.com/embed/lagbfvk_w5M" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

				
				<img  style="width:150px;" src="/img/tent.jpg" ALIGN="LEFT"/>
                <img  style="width:150px;" src="/img/inside-church.jpg" ALIGN="right"/>
				

				<p>The church family of Deliverance Center are strong believers in mission work. In 1967, Before there was a church at 1008 Congress, Ministry Pioneer James Reynolds, Sr. served the homeless and rejected of Portland, Maine. With a warm meal, clothing and a bed Bro. Reynolds, his family and the help of wonderful volunteers spread the love of Christ. Today, that vision for practical Christianity and service is our daily ambition. 
</p>
<img  style="width:150px;" src="/img/tent-trailer.jpg" align="left" />
					<p>Througout the past 45+, the Lord Jesus Christ has enabled Deliverance Center to teach children in a Christian School, train Christian workers in a Bible school, rescue the helpless and homeless on the streets of Portland and financialy and physically support mission work accross the world and at home.</p>

				<img  style="width:150px;" src="/img/tent-rockland.jpg" style="width:100%;"/>
                </div>
            </div>

            <div class="card">
                <div class="contents">
                <h2>Sermons</h2>
            @include('partials.sermons')
                  </div>
            </div>
@endsection

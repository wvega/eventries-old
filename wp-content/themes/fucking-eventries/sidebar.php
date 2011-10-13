                <!-- sidebar -->
				<div id="sidebar">
					<div id="sendevent">
						<a href="">Envianos tu evento</a>
					</div>
					<!-- sidebox -->
					<div class="sidebox">
					    <h3 class="item-title oranges">Eventos</h3>
						<div class="nipple nippleo"></div>
						<div class="item-content">
							<ul id="categorievents">
								<li>
									<a id="tech_cat" href="/plus">
										<div class="cat_icon"></div>
										<h4>Tecnol&oacute;gicos</h4>
										<p>Congresos, Conferencias, Fotos, Ruedas de negocios, Seminarios, Talleres..</p>
									</a>
								</li>  
								<li>
									<a id="academic_cat" href="/categories">
										<div class="cat_icon"></div>
										<h4>Acad&eacute;micos</h4>
										<p>Congresos, Conferencias, Seminarios, Talleres...</p>
									</a>
								</li>
								<li>
									<a id="culture_cat" href="/groups">
										<div class="cat_icon"></div>
										<h4>Culturales</h4>
										<p>Obras de teatro, Exposiciones, Ferias, Festivales...</p>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<!-- /sidebox -->
					<!-- sidebox -->
					<div class="sidebox">
					    <div id="eventspro">
                            <div id="arriba">
                                <div class="contenido">
                                    <a href="#"><img class="logo" src="<?php bloginfo('template_directory'); ?>/images/eventspro.png" alt="" /></a>
                                    <p class="intro">Inscripciones abiertas<a href="#"><img alt="Buy Tickets" src="<?php bloginfo('template_directory'); ?>/images/buytickets.png"></a>
                                    </p>
                                </div>
                            </div>
                            <div id="abajo">
                                <div class="contenido">
                                    <h4>
                                        <a id="more" href="#">Ver m&aacute;s</a>Pr&oacute;ximo evento
                                    </h4>
                                    <div id="date">
                                        Sep<span>30</span>
                                    </div>
                                    <p id="feed">
                                        <a href="#">Special, Mind-blowing outdoor video show!</a><br>This show will be the can’t-miss event of the Vimeo Festival + Awards. This projection mapping show will literally bend your mind at 10pm sharp on October 9th at 555 West 18th St.…
                                    </p>
                                </div>
                            </div>
                        </div>
					</div>
					<!-- /sidebox -->
					<!-- sidebox -->
					<div class="sidebox">
					    <h3 class="item-title yellows">Pr&oacute;ximos Eventos</h3>
						<div class="nipple nippley"></div>
						<div class="item-content">
							<?php get_last_events(1); ?>							
						</div>
					</div>
					<!-- /sidebox -->
				</div>
				<!-- sidebar -->		
			</div>
			<!-- /wrap -->

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                			$numscenes_as=mysql_result($result_as, '0', "act{$a}");
	   							if($numscenes_as < 1)
	   								break;
	   							$sc=1;
	   							while($sc <=$numscenes_as){
	   								$query_locs="SELECT * FROM Scenes WHERE playID LIKE '0' AND act=$a AND scene=$sc";
									$results_locs=mysql_query($query_locs);
									$loc=mysql_result($results_locs, 0, "location");

	   								$asid="{$a}.{$sc}";
	   								?>
									<input type="checkbox" name="<?php echo $asid ?>" id="<?php echo $asid ?>" class="custom"/>
									<label for="<?php echo $asid ?>"><?php echo "{$asid} {$loc}" ?></label>
									<?php
									$sc++;
	   							}
	   							$a++;
	   						}
	   					?>
   					 	</fieldset>
						
						<label for="newnote">Notes:</label>
						<textarea name="newnote" id="newnote">
						</textarea>
						
						<input type="submit" id="createElemButton" value="Create Set Element" />
					</div>
				</p>
				</p>
			</form>	
		</div>
	</div><!-- /content -->
	
	<div data-role="footer" data-id="navigation" data-position="fixed" data-theme="c" class="nav-glyphish-example">
		<div data-role="navbar" class="nav-glyphish-example">
		<ul>
			<li><a href="acts_view.php?<?php echo $playID?>" id="acts" data-icon="custom">Acts</a></li>
			<li><a href="characters_view.php?<?php echo $playID?>" id="chars" data-icon="custom">Characters/Actors</a></li>
			<li><a href="props_view.php?<?php echo $playID?>" id="props" data-icon="custom">Props</a></li>
			<li><a href="elements_view.php?<?php echo $playID?>" id="elements" data-icon="custom" class="ui-btn-active">Set Elements</a></li>
		</ul>
		</div>
	</div>

</div><!-- /page -->

</body>
</html>
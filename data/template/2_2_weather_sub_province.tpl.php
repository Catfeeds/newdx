<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
 <?php if(is_array($weather_forecast_city_result)) foreach($weather_forecast_city_result as $weather_province) { ?><div class="historyone">
<span class="w300"><a href="http://www.8264.com/weather/<?php echo $weather_province['pspell'];?>/<?php echo $weather_province['spell'];?>/" target="_blank"><?php echo $weather_province['city'];?>ÌìÆø</a></span>
<span class="w174"><?php echo $weather_province['maxTemp'];?>¡æ</span>
<span class="w174"><?php echo $weather_province['minTemp'];?>¡æ</span>
<span class="w174"><?php echo $weather_province['weather'];?></span>
<span class="w174"><?php echo $weather_province['wind_dir'];?></span>
<span class="w174"><?php echo $weather_province['wind_power'];?>¼¶</span>
</div>
<?php } ?>
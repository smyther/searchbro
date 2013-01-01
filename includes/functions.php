<?php

include('config.php');

function showResults($data)
{

		echo '<table>';

		$c = 0;

		if ( isset( $data->channel->item ) )
		{
			foreach ($data->channel->item as $item) 
			{
				$class = 'odd';

				if ($c == 1)
				{
					$c = 0; 
					$class = 'even';
				}
				else
				{
					$c++;
				}

				echo '<tr class="item '.$class.'">';
				echo '<td style="width: 62%;">'.$item->title.'</td>';
				echo '<td style="width: 10%;" class="center">'.howOld($item->pubDate).'</td>';
				echo '<td style="width: 10%;" class="center">'.round($item->enclosure->{'@attributes'}->length/1024/1024,1).'mb</td>';
				echo '<td style="width: 10%;" class="center bold">'.$item->category.'</td>';
				echo '<td style="width: 10%;" class="center"><a href="?addnzb=1&url='.urlencode($item->link).'"><img src="images/get.png" height="40"/></a></td>';
				echo '</tr>';

			}
		}
		else
		{
			echo '<tr class="item odd"><td>Sorry.. no results..</td></tr>';
		}

		echo '</table>';
}

// send nzb to our SAB install.

function toSab($url,$cat = NULL,$title = NULL)
{

	$config = config();

	$url = urlencode($url);

	if ($cat != NULL)
	{
		$cat = '&cat='.$cat;
	}

	if ($title != NULL)
	{
		$title = '&nzbname='.$title;
	}

	$toSab = $config['sabAddress'].'/api?mode=addurl&name='.$url.'&pp=3'.$cat.'&priority=-1'.$title.'&apikey='.$config['sabApiKey'];

	$send = file_get_contents($toSab);

	echo $send;

}

// work out how old post is and display relevant timing
function howOld($date){

		$age = time() - strtotime($date);

		$hours = round($age/60/60, 0);

		if ($hours <= 23)
		{
			$units = 'hours';
		}
		else if ($hours >= 24)
		{
			$hours = round($hours / 24, 0);
			$units = 'day';

			if ($hours > 1)
			{
				$units = 'days';
			}
		} 

		return $hours.' '.$units;
}

?>
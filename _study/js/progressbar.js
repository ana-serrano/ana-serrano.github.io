/**
 * ProgressBar for jQuery
 *
 * @version 1 (29. Dec 2012)
 * @author Ivan Lazarevic
 * @requires jQuery
 * @see http://workshop.rs
 *
 * @param  {Number} percent
 * @param  {Number} $element progressBar DOM element
 */
function progressBar(number, total, $element) {
	var progressBarWidth = (number/total) * $element.width();
	$element.find('div').animate({ width: progressBarWidth }, 500).html(number + "/&nbsp;" + total);
}
let trainComp = {};

(function($) {
	"use strict";

	trainComp = {
		init: function() {
			$(document).ready(function() {
				/**
				 * Create form date picker
				 */
				$(".traincomp-date-field").flatpickr({
					locale: "fr",
					dateFormat: "d/m/Y",
					minDate: new Date()
				});

				/**
				 * List calendar
				 */
				const todayDate = new Date();
				const minDate = new Date(
					todayDate.getTime() - 31 * 24 * 60 * 60 * 1000
				);

				$("#list-comps-calendar").datepicker({
					language: "fr",
					minDate: minDate,
					onRenderCell: function(date, cellType) {
						if (cellType === "day") {
							const key = trainComp.dateToYmd(date);

							if (
								window.trainCompData.future_compositions.hasOwnProperty(
									key
								)
							) {
								return {
									classes: "has-comp"
								};
							}

							return {
								disabled: true
							};
						}
					},
					onSelect: function onSelect(fd, date) {
						const key = trainComp.dateToYmd(date);

						if (
							window.trainCompData.future_compositions.hasOwnProperty(
								key
							)
						) {
							const compUrl =
								window.trainCompData.admin_url +
								"&c=" +
								window.trainCompData.future_compositions[key];

							window.location.href = compUrl;
						}
					}
				});

				/**
				 * Simple user view
				 */
				$("#user-list-comp select#timeslot").change(function() {
					let timeslot = $(this)
						.find("option:selected")
						.val();

					if (timeslot != "all") {
						$("article.wagon .timeslot")
							.not(".timeslot-" + timeslot)
							.slideUp();

						$("article.wagon .timeslot")
							.filter(".timeslot-" + timeslot)
							.slideDown();
					} else {
						$("article.wagon .timeslot").slideDown();
					}
				});
			});
		},

		dateToYmd: function(date) {
			var year, month, day;
			year = String(date.getFullYear());
			month = String(date.getMonth() + 1);
			if (month.length == 1) {
				month = "0" + month;
			}
			day = String(date.getDate());
			if (day.length == 1) {
				day = "0" + day;
			}
			return year + "" + month + "" + day;
		}
	};

	/**
	 * Fire the whole thing!
	 */
	trainComp.init();
})(jQuery);

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>My Contacts</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons|Roboto:300,400,500,700">
		<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
		
		<!--IE 11 does not support Material Design Dialog Component and must use dialog-polyfill-->
		<link rel="stylesheet" href="./css/dialog-polyfill.css">
		<!--/IE 11 does not support Material Design Dialog Component and must use dialog-polyfill-->

		<link rel="stylesheet" href="./css/all.css">

		<!--IE 11 does not support Material Design Dialog Component and must use dialog-polyfill-->
		<script defer src="./js/dialog-polyfill.js"></script>
		<!--/IE 11 does not support Material Design Dialog Component and must use dialog-polyfill-->

		<script defer src="./js/all.js<?php echo '?'.time(); ?>"></script>
	</head>
	<body>

		<dialog class="mdl-dialog">
			<h4 class="mdl-dialog__title">New Contact</h4>
			<div class="mdl-dialog__content">
				<form action="#" id="addContactForm">
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="text" pattern="[A-Z,a-z, ''-.]*" id="firstname" name="firstname">
						<label class="mdl-textfield__label" for="firstname">First Name</label>
						<span class="mdl-textfield__error">Letters and spaces only</span>
					</div>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="text" pattern="[A-Z,a-z, ''-.]*" id="lastname" name="lastname">
						<label class="mdl-textfield__label" for="lastname">Last Name</label>
						<span class="mdl-textfield__error">Letters and spaces only</span>
					</div>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="input" pattern="[\S+@\S+]*" id="email" name="email">
						<label class="mdl-textfield__label" for="email">Email</label>
						<span class="mdl-textfield__error">Valid email address only</span>
					</div>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="text" pattern="[0-9+ -]*" id="phone" name="phone">
						<label class="mdl-textfield__label" for="phone">Phone</label>
						<span class="mdl-textfield__error">Digits only</span>
					</div>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<select class="mdl-textfield__input" id="company" name="company_id">
							<option></option>
							<?php //This logic can be added to a helper for extending and manageability. ?>
							<?php if (isset($data['companies']) && count($data['companies']) > 0) : ?>
								<?php foreach($data['companies'] as $v) : ?>
									<option value="<?= $v['id'] ?>"><?= $v['company'] ?></option>
								<?php endforeach;?>
							<?php endif; ?>
						</select>
						<label class="mdl-textfield__label" for="company">Company</label>
					</div>
				</form>
			</div>
			<div class="mdl-dialog__actions">
				<button type="button" class="mdl-button submit">Submit</button>
				<button type="button" class="mdl-button close">Cancel</button>
			</div>
		</dialog>

		<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
			<header class="mdl-layout__header">
				<div class="mdl-layout__header-row">
					<span class="mdl-layout-title">My Contacts</span>
					<div class="mdl-layout-spacer"></div>
					<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="show-dialog">Add Contact</button>
				</div>
			</header>

			<main class="mdl-layout__content">
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--12-col">
						<div class="mdl-textfield mdl-js-textfield">
							<label class="mdl-button mdl-js-button mdl-button--icon" for="search-textfield" id="search-button">
								<i class="material-icons">search</i>
							</label>
							<div class="mdl-textfield__expandable-holder" id="search-textfield-container">
								<input class="mdl-textfield__input" type="text" name="sample" id="search-textfield" placeholder="Search">
								<label class="mdl-textfield__label" for="sample-expandable">Search</label>
							</div>
						</div>
						
						<table class="mdl-data-table mdl-data-table--selectable mdl-shadow--2dp" id="contacts-data-table">
							<thead>
								<tr>
									<th class="mdl-data-table__cell--non-numeric">First Name</th>
									<th class="mdl-data-table__cell--non-numeric">Last Name</th>
									<th class="mdl-data-table__cell--non-numeric mdl-data-table__cell--large-screen-only">Email</th>
									<th class="mdl-data-table__cell--non-numeric mdl-data-table__cell--large-screen-only">Phone</th>
									<th class="mdl-data-table__cell--non-numeric mdl-data-table__cell--large-screen-only">Company</th>
									<th class="mdl-data-table__cell--non-numeric"></th>
								</tr>
							</thead>
							<tbody>

								<?php //This logic can be added to a helper for manageability. ?>
								<?php if (isset($data['contacts']) && count($data['contacts']) > 0) : ?>
									<?php foreach($data['contacts'] as $v) : ?>
										<tr>
											<td class="mdl-data-table__cell--non-numeric"><?= $v['firstname'] ?></td>
											<td class="mdl-data-table__cell--non-numeric"><?= $v['lastname'] ?></td>
											<td class="mdl-data-table__cell--non-numeric mdl-data-table__cell--large-screen-only"><?= $v['email'] ?></td>
											<td class="mdl-data-table__cell--non-numeric mdl-data-table__cell--large-screen-only"><?= $v['phone'] ?></td>
											<td class="mdl-data-table__cell--non-numeric mdl-data-table__cell--large-screen-only"><?= $v['company'] ?></td>
											<td class="mdl-data-table__cell--non-numeric">
												<button class="mdl-button mdl-js-button mdl-button--icon edit-button" data-id="<?= $v['id'] ?>">
													<i class="material-icons">edit</i>
												</button>
												<button class="mdl-button mdl-js-button mdl-button--icon delete-button" data-id="<?= $v['id'] ?>">
													<i class="material-icons">delete_forever</i>
												</button>
											</td>
										</tr>
									<?php endforeach;?>
								<?php else: ?>
									<tr>
										<td colspan="6">No contacts found.</td>
									</tr>
								<?php endif; ?>

							</tbody>
						</table>

					</div>
				</div>
			</main>
		</div>

		


		<a href="https://github.com/dvelguru" id="view-source" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" target="_blank">View Source</a>

	</body>
</html>
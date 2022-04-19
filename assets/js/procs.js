class procs {
	listen() {
		$(document).on("click",".divdets ol li", () => {
			this.getcitiesinfo();
		})
	}

	getcitiesinfo() {
		
	}
}

window.onload = function() {
	var p = new procs();
		p.listen();
}
Vue.use(VueMask.VueMaskPlugin);
Vue.directive("masktelefone", VueMask.VueMaskDirective);
Vue.directive("maskcpf", VueMask.VueMaskDirective);

var app = new Vue({
	el: "#app",

	data: {
		keywords: "",
		modal: { title: "Adicionar " },
		error: { nome: "*", cpf: "*", telefone: "*", dataNascimento: "*" },
		cliente: {
			id: "",
			nome: "",
			cpf: "",
			telefone: "",
			dataNascimento: "",
			action: "",
		},
		clientes: [],
		pesquisa: "",
		urlPost: "http://localhost/clientes",
		disabledButton: false,
		reverse: false,
		messageResult: "",
		masktelefone: "(##) ####-####",
		maskcpf: "###.###.###-##",
	},

	created: function () {
		this.allRecords();
	},

	methods: {
		search(event) {
			var params = {
				filterByCliente: this.keywords,
				action: "filterByCliente",
			};
			const json = JSON.stringify(params);
			axios
				.post(this.urlPost, json)
				.then(function (response) {
					app.clientes = JSON.parse(response.data);
				})
				.catch(function (error) {
					console.log(error);
				});
		},

		merge: function () {
			if (this.validateForm()) {
				this.disabledButton = true;
				this.messageResult = "Enviando, por favor aguarde!";

				if (app.cliente.id == "") {
					app.cliente.action = "save";
				} else {
					app.cliente.action = "update";
				}

				const json = JSON.stringify(app.cliente);
				axios
					.post(this.urlPost, json)
					.then(function (response) {
						console.log(response.data);

						var cliente = response.data;
						if (cliente.status == "200") {
							if (app.cliente.action == "save") {
								app.resetForm();
								app.resetError();
							}
							app.disabledButton = false;
							app.messageResult = cliente.msg;

							Swal.fire({
								position: "top-end",
								icon: "success",
								title: cliente.msg,
								showConfirmButton: false,
								timer: 2000,
							});
						} else {
							app.messageResult = cliente.msg;

							Swal.fire({
								icon: "error",
								title: "Oops... por favor tente novamente!",
								text: cliente.msg,
								footer: "<a href>Contate Administrador!</a>",
							});
						}
						app.allRecords();
					})
					.catch(function (error) {
						console.log(error);
					});
			}
		},

		editCliente: function (cliente) {
			this.modal.title = "Editar";
			app.cliente.id = cliente.id;
			app.cliente.nome = cliente.nome;
			app.cliente.cpf = cliente.cpf;
			app.cliente.telefone = cliente.telefone;
			app.cliente.dataNascimento = cliente.datanascimento;
			app.messageResult = "";

			$("#modalCliente").modal({
				show: true,
			});
		},

		allRecords: function () {
			axios
				.get(this.urlPost)
				.then(function (response) {
					console.log(JSON.stringify(response.data));
					app.clientes = response.data;
				})
				.catch(function (error) {
					console.log(error);
				});
		},

		validateForm: function () {
			var error = 0;
			this.resetError();
			if (this.cliente.nome.length < 4) {
				this.error.nome = "Por favor, inserir um nome valido (4 caracters)";
				error++;
			}

			if (this.cliente.cpf.length == 0) {
				this.error.cpf = "Invalido, Por favor inserir cpf";
				error++;
			}

			if (this.cliente.dataNascimento == "") {
				this.error.dataNascimento =
					"Invalido, Por favor inserir data de nascimento";
				error++;
			}

			if (this.cliente.telefone.length == 0) {
				this.error.telefone = "Invalido telefone (11 caracters)";
				error++;
			}

			return error === 0;
		},
		resetForm: function () {
			this.cliente.nome = "";
			this.cliente.cpf = "";
			this.cliente.telefone = "";
			this.cliente.dataNascimento = "";
			this.messageResult = "";
			//this.$refs.nome.focus();
		},
		resetError: function () {
			this.error.nome = "*";
			this.error.cpf = "*";
			this.error.telefone = "*";
			this.error.dataNascimento = "*";
			this.error.anexo = "*";
		},

		removeCliente: function (cliente) {
			var msg = cliente.nome + " os dados serão atualizados!";

			Swal.fire({
				title: " Deseja realmente deletar ? ",
				text: msg,
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Sim, deletar cliente ?",
			}).then((result) => {
				if (result.value) {
					app.cliente.id = cliente.id;
					app.cliente.action = "delete";
					const json = JSON.stringify(app.cliente);
					axios
						.post(this.urlPost, json)
						.then(function (response) {
							app.allRecords();

							Swal.fire("Deletado!", "Seu cliente foi deletado.", "success");
						})
						.catch(function (error) {
							console.log(error);
						});
				}
			});
		},

		openForm: function (show) {
			if (show) {
				$("#modalCliente").show("fast");
				this.resetForm();
				this.resetError();
			} else {
				$("#modalCliente").show("slow");
			}
		},

		search: function () {
			console.log(this.pesquisa);
			app.cliente.filter = this.pesquisa;
			app.cliente.action = "filterByCliente";
			const json = JSON.stringify(app.cliente);
			axios
				.post(this.urlPost, json)
				.then(function (response) {
					app.clientes = JSON.parse(response.data);
				})
				.catch(function (error) {
					app.messageResult = response.data.msg;
				});
		},
	},
});

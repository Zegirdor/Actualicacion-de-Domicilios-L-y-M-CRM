	var token;
	var conversationId;
	var userId;
	var userName;
	var agent_participantId;
	var phone;
	var clientId;
	var campaignId;
	var urlRedirect = "http://10.50.1.99:8080/CreditoDev/Janeth/CRMActualizarDdomiciliosLyM/index.php";

	var config = {
			"environment": "mypurecloud.com",
			"clientId": "5858c955-b70e-49bf-adda-50b4659629aa",
			"redirectUri" : "http://10.50.1.99:8080/CreditoDev/Janeth/CRMActualizarDdomiciliosLyM/redireccionar"
		};

	$(document).ready(function(){
		$("#endCallBtn").prop('disabled', true);

		if(window.location.hash)
		{
			//console.log(location.hash);
			token = getParameterByName('access_token', window.location.hash);

			$.ajax({
				url: "https://api." + config.environment + "/api/v2/users/me",
				type: "GET",
				beforeSend: function(xhr){xhr.setRequestHeader('Authorization', 'bearer ' + token);},
				success: showUserInfo
			});

			location.hash=''

		} else {

			var queryStringData = {
				response_type : "token",
				client_id : config.clientId,
				redirect_uri : config.redirectUri
			}

			//console.log(jQuery.param(queryStringData));
			window.location.replace("https://login." + config.environment + "/authorize?" + jQuery.param(queryStringData));
		}

	});


	function getParameterByName(name, data) {
		name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
		var regex = new RegExp("[\\#&?]" + name + "=([^&#?]*)"),
		  results = regex.exec(data);
		return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	}

	function showUserInfo(data) {
	console.log(data);
		var name = $("<p></p>").text("AgentName: " +  data.name);
		var id = $("<p></p>").text("AgentId: " + data.id);

		userId = data.id;
		userName = data.department;
		getActiveConversation();

		$("#callDetail").append(id, name);
        console.log(data);
    }

	function getAgentParticipantId(conversationId, userId){
		campaign = 'UNIFICACIONMIXTA';
			/*cliente = '123';
			clienteid ='123';*/

		let url = "https://api." + config.environment + "/api/v2/conversations/" + conversationId;
		$.ajax({
				type: "GET",
				url: url,
				contentType: "application/json",
				dataType: 'json',
				headers: {'Authorization': 'Bearer ' + token},
				success: function(result){

					if(result.participants)
					{
						//console.log(result.participants, "participants");
						$.each( result.participants, function( i, participant )
						{
							if( participant.purpose == "agent" && participant.userId == userId )
							{
								agent_participantId = participant.id;

								var txtParticipantId = $("<p></p>").text("ParticipantId: " +  agent_participantId);
								$("#callDetail").append(txtParticipantId);

							}
							else if( participant.purpose == "customer" || participant.purpose == "user" )
							{
								phone = participant.address.replace(/\D/g,"");
								if(phone.startsWith("52"))
									phone = phone.replace("52", "");

								if(participant.attributes)
								{
									clientId = participant.attributes.dialerContactId;
									campaignId = participant.attributes.dialerCampaignId;
								}
							}


						});
					}

					urlRedirect =  urlRedirect + "?username=" + userName + "&answernumber=" + phone +"&llamada_id=" + conversationId + "&token=" + token + "&participanteId=" + agent_participantId+ "&id_genesys="+ conversationId + "&campaign=" + campaign + "&cliente=" +clientId+ "&clienteid=" + clientId;
					// urlRedirect =  urlRedirect + "?username=" + userName + "&answernumber=" + phone + "&id_genesys=";
					window.location.href = urlRedirect;
				}

			});
	}

	function getActiveConversation(){
		let url = "https://api." + config.environment + "/api/v2/conversations?communicationType=call";
		$.ajax({
				type: "GET",
				url: url,
				contentType: "application/json",
				dataType: 'json',
				headers: {'Authorization': 'Bearer ' + token},
				success: function(result){

					if(result.total > 0 && result.entities)
					{
						//console.log(result.entities, "active calls");
						$("#endCallBtn").prop('disabled', false);

						$.each( result.entities, function( i, call ){
							conversationId = call.id;

							var txtConversationId = $("<p></p>").text("ConversationId: " +  conversationId);
							$("#callDetail").append(txtConversationId);

						});


						getAgentParticipantId(conversationId, userId);

					}
					else
					{
						alert("No hay interacciones activas");
					}

				}

			});
	}

	function endCall(){
		let url = "https://api." + config.environment + "/api/v2/conversations/calls/" +  conversationId + "/participants/" + agent_participantId;
		let data =	{"state":"DISCONNECTED"};

		$.ajax({
					type: "PATCH",
					url: url,
					headers: {'Authorization': 'Bearer ' + token},
					data: JSON.stringify(data),
					contentType: "application/json",
					dataType: 'json',
					success: function(result){
						alert("Llamada finalizada");
					}
				});
	}
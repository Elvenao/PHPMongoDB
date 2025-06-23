@OptIn(ExperimentalMaterialApi::class)
@Composable
fun crearPost(navController: NavController) {
    //Todo: Validar textos, que no esten vacios, que el titulo no sea muy largo, que el contenido no sea muy largo, que la opcion seleccionada sea valida y datos del multimedia
    val EncryptedSharedPreferences = SecurePrefs(LocalContext.current)
    val currentUserData = EncryptedSharedPreferences.getCurrentUserData()
    var title by remember { mutableStateOf("") }
    var content by remember { mutableStateOf("") }
    var expanded by remember { mutableStateOf(false) }
    val opciones = listOf("Opción 1", "Opción 2", "Opción 3", "Opción 4", "Opción 5", "Opción 6", "Opción 7", "Opción 8", "Opción 9", "Opción 10")
    var seleccion by remember { mutableStateOf(opciones[0]) }
    val listState = rememberLazyListState()
    val context = LocalContext.current

    Scaffold(
        topBar = {
            TopAppBar(
                title = { Text("Crear nuevo post") }
            )
        }
    ) { innerPadding ->
        LazyColumn(
            state = listState,
            modifier = Modifier
                .padding(innerPadding)
                .padding(16.dp)
                .fillMaxSize(),
            verticalArrangement = Arrangement.Top
        ) {
            item {
                Text("Titulo", modifier = Modifier.padding(bottom = 8.dp))
                TextField(
                    value = title,
                    onValueChange = { title = it },
                    label = { Text("Título") },
                    modifier = Modifier
                        .fillMaxWidth()
                        .height(150.dp)
                )
                Spacer(modifier = Modifier.height(16.dp))

                Text("¿A que contenido te refieres?", modifier = Modifier.padding(bottom = 8.dp))
                TextField(
                    value = "Pelicula 1",
                    onValueChange = {}, // No hace nada
                    readOnly = true,
                    label = { Text("Media") },
                    modifier = Modifier
                        .fillMaxWidth()
                        .height(50.dp)
                )
                Spacer(modifier = Modifier.height(16.dp))
                Text("Contenido del post", modifier = Modifier.padding(bottom = 8.dp))
                TextField(
                    value = content,
                    onValueChange = { content = it },
                    label = { Text("¿Qué estás pensando?") },
                    modifier = Modifier
                        .fillMaxWidth()
                        .height(150.dp)
                )
                Spacer(modifier = Modifier.height(16.dp))
                ExposedDropdownMenuBox(
                    expanded = expanded,
                    onExpandedChange = { expanded = !expanded }
                ) {
                    TextField(
                        value = seleccion,
                        onValueChange = {},
                        readOnly = true,
                        label = { Text("Selecciona una opción") },
                        trailingIcon = { ExposedDropdownMenuDefaults.TrailingIcon(expanded = expanded) },
                        modifier = Modifier.fillMaxWidth()
                    )
                    ExposedDropdownMenu(
                        expanded = expanded,
                        onDismissRequest = { expanded = false }
                    ) {
                        opciones.forEach { opcion ->
                            DropdownMenuItem(
                                text = { Text(opcion) },
                                onClick = {
                                    seleccion = opcion
                                    expanded = false
                                }
                            )
                        }
                    }
                }
                Spacer(modifier = Modifier.height(16.dp))
                Button(
                    onClick = {
                        if(title.isEmpty() || content.isEmpty()) {
                            Toast.makeText(context, "Por favor, completa todos los campos", Toast.LENGTH_SHORT).show()
                            return@Button
                        }else{
                            Toast.makeText(context, "Post creado con éxito", Toast.LENGTH_SHORT).show()
                            val post = Post(null,currentUserData?.userName ?: "",currentUserData?.id ?: "",
                                title, "","",currentUserData?.avatar.toString(),"0",content,"/Images/no_photo.jpg",
                                seleccion,emptyList()
                            )
                            RetrofitClient.instance.crearPost(post)
                            navController.popBackStack()
                        }
                    },
                    modifier = Modifier
                        .fillMaxWidth()
                        .padding(top = 16.dp)
                ) {
                    Text("Publicar")
                }
            }
        }
    }
}
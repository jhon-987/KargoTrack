            <section class="pendientes">
                <div class="pendientes-bloque">
                    <div class="pendientes-cabecera">
                        <h3>Esperando envío</h3>
                        <a href="index.php?accion=listarEnvios">Programar envío →</a>
                    </div>
                    <?php if (empty($esperando)) { ?>
                    <p class="pendientes-vacio">No hay encomiendas esperando, todas ya salieron.</p>
                    <?php } else { ?>
                    <table>
                        <thead>
                            <tr>
                                <th>N.°</th>
                                <th>Cliente</th>
                                <th>Destino</th>
                                <th>Peso</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($esperando as $fila) { ?>
                            <tr>
                                <td><?php echo (int) $fila['id_encomienda']; ?></td>
                                <td><?php echo htmlspecialchars($fila['nombre'] . ' ' . $fila['apellido']); ?></td>
                                <td><?php echo htmlspecialchars($fila['destino']); ?></td>
                                <td><?php echo htmlspecialchars($fila['peso']); ?> kg</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php } ?>
                </div>

                <div class="pendientes-bloque">
                    <div class="pendientes-cabecera">
                        <h3>En camino</h3>
                        <a href="index.php?accion=listarSeguimiento">Registrar seguimiento →</a>
                    </div>
                    <?php if (empty($enCamino)) { ?>
                    <p class="pendientes-vacio">No hay envíos en camino en este momento.</p>
                    <?php } else { ?>
                    <table>
                        <thead>
                            <tr>
                                <th>N.°</th>
                                <th>Destino</th>
                                <th>Vehículo</th>
                                <th>Chofer</th>
                                <th>Llega</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($enCamino as $fila) { ?>
                            <tr>
                                <td><?php echo (int) $fila['id_encomienda']; ?></td>
                                <td><?php echo htmlspecialchars($fila['destino']); ?></td>
                                <td><?php echo htmlspecialchars($fila['placa']); ?></td>
                                <td><?php echo htmlspecialchars($fila['chofer']); ?></td>
                                <td><?php echo htmlspecialchars($fila['fecha_llegada']); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php } ?>
                </div>
            </section>

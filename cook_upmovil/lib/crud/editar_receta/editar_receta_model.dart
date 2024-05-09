import '/auth/firebase_auth/auth_util.dart';
import '/backend/backend.dart';
import '/backend/firebase_storage/storage.dart';
import '/flutter_flow/flutter_flow_drop_down.dart';
import '/flutter_flow/flutter_flow_icon_button.dart';
import '/flutter_flow/flutter_flow_theme.dart';
import '/flutter_flow/flutter_flow_util.dart';
import '/flutter_flow/flutter_flow_widgets.dart';
import '/flutter_flow/form_field_controller.dart';
import '/flutter_flow/upload_data.dart';
import 'package:cloud_firestore/cloud_firestore.dart';
import 'package:flutter/material.dart';
import 'package:flutter_rating_bar/flutter_rating_bar.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:provider/provider.dart';

class EditarRecetaModel extends FlutterFlowModel {
  ///  State fields for stateful widgets in this page.

  // State field(s) for nombreReceta widget.
  TextEditingController? nombreRecetaController;
  String? Function(BuildContext, String?)? nombreRecetaControllerValidator;
  // State field(s) for porciones widget.
  TextEditingController? porcionesController;
  String? Function(BuildContext, String?)? porcionesControllerValidator;
  // State field(s) for ingredientes widget.
  TextEditingController? ingredientesController;
  String? Function(BuildContext, String?)? ingredientesControllerValidator;
  // State field(s) for procedimiento widget.
  TextEditingController? procedimientoController;
  String? Function(BuildContext, String?)? procedimientoControllerValidator;
  // State field(s) for categories widget.
  String? categoriesValue;
  FormFieldController<String>? categoriesValueController;
  bool isDataUploading = false;
  FFUploadedFile uploadedLocalFile =
      FFUploadedFile(bytes: Uint8List.fromList([]));
  String uploadedFileUrl = '';

  // State field(s) for RatingBar widget.
  double? ratingBarValue;

  /// Initialization and disposal methods.

  void initState(BuildContext context) {}

  void dispose() {
    nombreRecetaController?.dispose();
    porcionesController?.dispose();
    ingredientesController?.dispose();
    procedimientoController?.dispose();
  }

  /// Additional helper methods are added here.

}

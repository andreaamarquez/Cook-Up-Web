import '/auth/firebase_auth/auth_util.dart';
import '/backend/backend.dart';
import '/backend/firebase_storage/storage.dart';
import '/flutter_flow/flutter_flow_expanded_image_view.dart';
import '/flutter_flow/flutter_flow_icon_button.dart';
import '/flutter_flow/flutter_flow_theme.dart';
import '/flutter_flow/flutter_flow_util.dart';
import '/flutter_flow/flutter_flow_widgets.dart';
import '/flutter_flow/upload_data.dart';
import 'package:cloud_firestore/cloud_firestore.dart';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:page_transition/page_transition.dart';
import 'package:provider/provider.dart';

class EditarCategoriaModel extends FlutterFlowModel {
  ///  State fields for stateful widgets in this page.

  // State field(s) for idCategoria widget.
  TextEditingController? idCategoriaController;
  String? Function(BuildContext, String?)? idCategoriaControllerValidator;
  // State field(s) for nombreCategoria widget.
  TextEditingController? nombreCategoriaController;
  String? Function(BuildContext, String?)? nombreCategoriaControllerValidator;
  bool isDataUploading = false;
  FFUploadedFile uploadedLocalFile =
      FFUploadedFile(bytes: Uint8List.fromList([]));
  String uploadedFileUrl = '';

  /// Initialization and disposal methods.

  void initState(BuildContext context) {}

  void dispose() {
    idCategoriaController?.dispose();
    nombreCategoriaController?.dispose();
  }

  /// Additional helper methods are added here.

}

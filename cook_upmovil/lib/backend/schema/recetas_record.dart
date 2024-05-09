import 'dart:async';

import '/backend/schema/util/firestore_util.dart';
import '/backend/schema/util/schema_util.dart';

import 'index.dart';
import '/flutter_flow/flutter_flow_util.dart';

class RecetasRecord extends FirestoreRecord {
  RecetasRecord._(
    DocumentReference reference,
    Map<String, dynamic> data,
  ) : super(reference, data) {
    _initializeFields();
  }

  // "nombreReceta" field.
  String? _nombreReceta;
  String get nombreReceta => _nombreReceta ?? '';
  bool hasNombreReceta() => _nombreReceta != null;

  // "porciones" field.
  int? _porciones;
  int get porciones => _porciones ?? 0;
  bool hasPorciones() => _porciones != null;

  // "procedimiento" field.
  String? _procedimiento;
  String get procedimiento => _procedimiento ?? '';
  bool hasProcedimiento() => _procedimiento != null;

  // "categoria" field.
  String? _categoria;
  String get categoria => _categoria ?? '';
  bool hasCategoria() => _categoria != null;

  // "valoracion" field.
  int? _valoracion;
  int get valoracion => _valoracion ?? 0;
  bool hasValoracion() => _valoracion != null;

  // "imagen" field.
  String? _imagen;
  String get imagen => _imagen ?? '';
  bool hasImagen() => _imagen != null;

  // "ingredientes" field.
  String? _ingredientes;
  String get ingredientes => _ingredientes ?? '';
  bool hasIngredientes() => _ingredientes != null;

  void _initializeFields() {
    _nombreReceta = snapshotData['nombreReceta'] as String?;
    _porciones = snapshotData['porciones'] as int?;
    _procedimiento = snapshotData['procedimiento'] as String?;
    _categoria = snapshotData['categoria'] as String?;
    _valoracion = snapshotData['valoracion'] as int?;
    _imagen = snapshotData['imagen'] as String?;
    _ingredientes = snapshotData['ingredientes'] as String?;
  }

  static CollectionReference get collection =>
      FirebaseFirestore.instance.collection('recetas');

  static Stream<RecetasRecord> getDocument(DocumentReference ref) =>
      ref.snapshots().map((s) => RecetasRecord.fromSnapshot(s));

  static Future<RecetasRecord> getDocumentOnce(DocumentReference ref) =>
      ref.get().then((s) => RecetasRecord.fromSnapshot(s));

  static RecetasRecord fromSnapshot(DocumentSnapshot snapshot) =>
      RecetasRecord._(
        snapshot.reference,
        mapFromFirestore(snapshot.data() as Map<String, dynamic>),
      );

  static RecetasRecord getDocumentFromData(
    Map<String, dynamic> data,
    DocumentReference reference,
  ) =>
      RecetasRecord._(reference, mapFromFirestore(data));

  @override
  String toString() =>
      'RecetasRecord(reference: ${reference.path}, data: $snapshotData)';
}

Map<String, dynamic> createRecetasRecordData({
  String? nombreReceta,
  int? porciones,
  String? procedimiento,
  String? categoria,
  int? valoracion,
  String? imagen,
  String? ingredientes,
}) {
  final firestoreData = mapToFirestore(
    <String, dynamic>{
      'nombreReceta': nombreReceta,
      'porciones': porciones,
      'procedimiento': procedimiento,
      'categoria': categoria,
      'valoracion': valoracion,
      'imagen': imagen,
      'ingredientes': ingredientes,
    }.withoutNulls,
  );

  return firestoreData;
}

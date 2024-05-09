import 'dart:async';

import '/backend/schema/util/firestore_util.dart';
import '/backend/schema/util/schema_util.dart';

import 'index.dart';
import '/flutter_flow/flutter_flow_util.dart';

class CategoriasRecord extends FirestoreRecord {
  CategoriasRecord._(
    DocumentReference reference,
    Map<String, dynamic> data,
  ) : super(reference, data) {
    _initializeFields();
  }

  // "categoria" field.
  String? _categoria;
  String get categoria => _categoria ?? '';
  bool hasCategoria() => _categoria != null;

  // "imagenCategoria" field.
  String? _imagenCategoria;
  String get imagenCategoria => _imagenCategoria ?? '';
  bool hasImagenCategoria() => _imagenCategoria != null;

  // "idCategoria" field.
  String? _idCategoria;
  String get idCategoria => _idCategoria ?? '';
  bool hasIdCategoria() => _idCategoria != null;

  void _initializeFields() {
    _categoria = snapshotData['categoria'] as String?;
    _imagenCategoria = snapshotData['imagenCategoria'] as String?;
    _idCategoria = snapshotData['idCategoria'] as String?;
  }

  static CollectionReference get collection =>
      FirebaseFirestore.instance.collection('categorias');

  static Stream<CategoriasRecord> getDocument(DocumentReference ref) =>
      ref.snapshots().map((s) => CategoriasRecord.fromSnapshot(s));

  static Future<CategoriasRecord> getDocumentOnce(DocumentReference ref) =>
      ref.get().then((s) => CategoriasRecord.fromSnapshot(s));

  static CategoriasRecord fromSnapshot(DocumentSnapshot snapshot) =>
      CategoriasRecord._(
        snapshot.reference,
        mapFromFirestore(snapshot.data() as Map<String, dynamic>),
      );

  static CategoriasRecord getDocumentFromData(
    Map<String, dynamic> data,
    DocumentReference reference,
  ) =>
      CategoriasRecord._(reference, mapFromFirestore(data));

  @override
  String toString() =>
      'CategoriasRecord(reference: ${reference.path}, data: $snapshotData)';
}

Map<String, dynamic> createCategoriasRecordData({
  String? categoria,
  String? imagenCategoria,
  String? idCategoria,
}) {
  final firestoreData = mapToFirestore(
    <String, dynamic>{
      'categoria': categoria,
      'imagenCategoria': imagenCategoria,
      'idCategoria': idCategoria,
    }.withoutNulls,
  );

  return firestoreData;
}
